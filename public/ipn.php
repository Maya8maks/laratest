<?php

$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

    $question = $_POST['custom'];
$handler = fopen('text.txt', 'w');
//foreach($_POST as $key => $value) fwrite($handler, $key.' = '.$value.'          ');
fwrite($handler, $request);
fclose($handler);

    $email = $_POST['item_name'];
//    $question = "Some text";
//    $email = "admin@capmblog.com";
    $txn_id = $_POST['txn_id'];
    $payment_status = $_POST['payment_status'];
    $payer_status = $_POST['payer_status'];
//$handler = fopen('text.txt', 'w');
//fwrite($handler, "HEllo");
//fclose($handler);

//and $payment_status == "Completed"
if($question and $email and $payment_status == "Completed"  and $payer_status == "verified" ) {
    $servername = "127.0.0.1";
    $username = "laratest";
    $password = "laratest007";
    $dbname = "laratest";

    $description;
    $user_id;
    $date_add;
    $status = 0;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
        $stmt = $conn->prepare("SELECT * FROM `Temp_Question` WHERE question = \"$question\" and email = \"$email\" ORDER BY date_add DESC LIMIT 1");
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $description = $row->description;
            $user_id = $row->user_id;
            $date_add = $row->date_add;
        }
        $sql = "INSERT INTO `Question`(`question`, `description`, `user_email`, `user_id`, `txn_id`, `date_add`,`status`,`updated_at`,`created_at`) VALUES (:question, :description,:email, :user_id,:txn_id,:date_add, :status,:updated_at, :created_at)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':txn_id', $txn_id);
        $stmt->bindParam(':date_add', $date_add);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':updated_at', $date_add);
        $stmt->bindParam(':created_at', $date_add);
        $stmt->execute();

        if($stmt = $conn->prepare("DELETE FROM `Temp_Question` WHERE question = \"$question\" and email = \"$email\" ORDER BY date_add DESC LIMIT 1")) {
            $stmt->execute();
        }

    } catch
    (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}
?>
<?php
require __DIR__.'/../vendor/autoload.php';
require __DIR__ .'/ReturnPaypal';
use Carbon\Carbon;
$servername = "127.0.0.1";
$username = "laratest";
$password = "laratest007";
$dbname = "laratest";
$time = Carbon::now()->format('Y-m-d H:i:s');
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
    $stmt = $conn->prepare("SELECT * FROM `Question`");
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach($result as $question) {
        $questionDate = Carbon::parse($question['date_add']);
        if($questionDate->diffInDays($time) > 1) {
            $txn_id = $question['txn_id'];
            $apiCredentials = [
                'signature' => 'AOvLUQDHniM6GlAmAKzlo20vm.h9ALzBeVnmgTjhpPRKgYvRJ.oJL.DT',
                'Username' => 'kruhlov_1-facilitator_api1.ukr.net',
                'Password' => '722RFJZ3JV53A3VN',
                'txn_id' => $txn_id,
            ];
            $return = new ReturnPaypal();
            $return->refundTransaction($apiCredentials);
            if($stmt = $conn->prepare("DELETE FROM `Question` WHERE txn_id = \"$txn_id \"")) {
                $stmt->execute();
            }
        }
    }
}catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>
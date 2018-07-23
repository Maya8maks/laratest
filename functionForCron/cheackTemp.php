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
    $stmt = $conn->prepare("SELECT * FROM `Temp_Question`");
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach($result as $question) {
        $questionDate = Carbon::parse($question['date_add']);
        if($questionDate->diffInHours($time) > 2) {
            $id = $question['id'];
            if($stmt = $conn->prepare("DELETE FROM `Temp_Question` WHERE id = \"$id\"")) {
                $stmt->execute();
            }
        }
    }
}catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>

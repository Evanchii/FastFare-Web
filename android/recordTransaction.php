<?php 
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $passenger = $_POST['passenger'];
    $driver = $_POST['driver'];
    $amount = $_POST['amount'];
    $distance = $_POST['distance'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];

    $sql = "SELECT `balance` FROM `users` WHERE `uid` = '$passenger'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result)['balance'];
        
        if($row >= $amount) {
            $sql = "UPDATE `users` SET `balance`=users.balance-$amount  WHERE `uid` = $passenger;";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE `users` SET `balance`=users.balance+$amount  WHERE `uid` = $driver";
            $result = mysqli_query($conn, $sql);

            $ts = time();

            $sql = "INSERT INTO `history`(
                `timestamp`,
                `passenger_uid`,
                `driver_uid`,
                `amount`,
                `distance`,
                `origin`,
                `destination`
            )
            VALUES(
                $ts,
                '$passenger',
                '$driver',
                '$amount',
                '$distance',
                '$origin',
                '$destination'
            )";
            $result = mysqli_query($conn, $sql);

            echo json_encode(array('success' => 'Payment Successful.'));
        } else {
            echo json_encode(array('error' => 'Insufficient Balance.'));
        }
    }
}
?>
<?php 
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $amount = $_POST['amount'];

    $sql = "SELECT `uid` FROM `authentication` WHERE `email` = $receiver OR `contact` = $receiver";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $receiver = mysqli_fetch_assoc($result)['uid'];

        $sql = "SELECT `balance` FROM `users` WHERE `uid` = '$sender'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result)['balance'];
            
            if($row >= $amount) {
                $sql = "UPDATE `users` SET `balance`=users.balance-$amount  WHERE `uid` = $sender;";
                $result = mysqli_query($conn, $sql);

                $sql = "UPDATE `users` SET `balance`=users.balance+$amount  WHERE `uid` = $receiver";
                $result = mysqli_query($conn, $sql);

                $ts = time();
                
                $sql = "INSERT INTO `balance_history`(
                    `timestamp`,
                    `amount`,
                    `type`,
                    `sender`,
                    `receiver`,
                    `status`
                )
                VALUES(
                    $ts,
                    '$amount',
                    '0',
                    '$sender',
                    '$receiver',
                    '2'
                )";
                $result = mysqli_query($conn, $sql);

                echo json_encode(array('success' => 'Transfer Successful.'));
            } else {
                echo json_encode(array('error' => 'Insufficient Balance.'));
            }
        }
    } else {
        echo json_encode(array('error' => 'User not found.'));
    } 
}
?>
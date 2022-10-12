<?php 
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];
    $partner = $_POST['partner'];
    $amount = $_POST['amount'];

    $sql = "UPDATE `users` SET `balance`=users.balance+$amount  WHERE `uid` = $uid";
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
        '1',
        '$partner',
        '$uid',
        '2'
    )";
    $result = mysqli_query($conn, $sql);
    echo $sql;

    echo json_encode(array('success' => 'Transfer Successful.'));
}
?>
<?php
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];

    $sql = "SELECT `balance` FROM `users` WHERE `uid` = '$uid'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        echo json_encode(array('balance' => $row['balance']));
    } else {
        echo json_encode(array('error' => "There was a problem while fetching your data."));
    }
}

?>
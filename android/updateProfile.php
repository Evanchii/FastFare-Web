<?php 
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $bday = $_POST['bday'];
    $contact = $_POST['contact'];
    $uid = $_POST['uid'];

    $sql = "UPDATE
        `users`
    SET
        `firstname` = '$fname',
        `middlename` = '$mname',
        `lastname` = '$lname',
        `address` = '$address',
        `birthday` = '$bday'
    WHERE
        `uid` = $uid";

    mysqli_query($conn, $sql);

    $sql = "UPDATE
        `authentication`
    SET
        `contact` = '$contact'
    WHERE
        `uid` = $uid";

    mysqli_query($conn, $sql);

    echo json_encode(array("success" => "Profile Updated"));
}
?>
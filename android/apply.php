<?php 
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];
    $plateNumber = $_POST['pnumber'];
    $route = $_POST['route'];
    $type = $_POST['type'];
    $id = $_POST['id'];
    $registration = $_POST['registration'];

    $sql = "SELECT `uid` FROM `applications` WHERE `uid` = '$uid'";

    $result = mysqli_query($conn, $sql);

    $ts = time();

    $sql = mysqli_num_rows($result) <= 0 ? "INSERT INTO `applications`(
        `uid`,
        `appliedAt`,
        `status`,
        `platenumber`,
        `route`,
        `puvtype`,
        `id`,
        `registration`
    )
    VALUES(
        '$uid',
        $ts,
        '0',
        '$plateNumber',
        '$route',
        '$type',
        '$id',
        '$registration'
    )" : "UPDATE
        `applications`
    SET
        `appliedAt` = NULL,
        `status` = '0',
        `platenumber` = '$plateNumber',
        `route` = '$route',
        `puvtype` = '$type',
        `id` = '$id',
        `registration` = '$registration'
    WHERE
        `uid` = $uid";

    $result = mysqli_query($conn, $sql);

    echo json_encode(array('success' => 'Application saved'));
}
?>
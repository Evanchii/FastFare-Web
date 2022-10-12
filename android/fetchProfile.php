<?php
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];

    $sql = "SELECT
        users.*,
        authentication.contact,
        authentication.email
    FROM
        `users`
    LEFT OUTER JOIN `authentication` ON users.uid = authentication.uid
    WHERE
        users.uid = $uid";
    
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        echo json_encode(array('data' => mysqli_fetch_assoc($result)));
    } else {
        echo json_encode(array('error' => "An Error has Occured. User not found."));
    }
}
?>
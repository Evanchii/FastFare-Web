<?php
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataID = $_POST['id'];
    $sql = 'SELECT * FROM `history` WHERE `timestamp`='.$dataID;
    $response = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($response) > 0) {
        $data = mysqli_fetch_all($response)[0];
        $sql = "SELECT
                users.firstname,
                users.middlename,
                users.lastname,
                applications.platenumber
            FROM
                `users`
            LEFT OUTER JOIN `applications` ON users.uid = applications.uid
            WHERE
                users.uid = $data[2]";
                
        $response = mysqli_query($conn, $sql);
        $data = array_merge($data, mysqli_fetch_all($response)[0]);
                
        $sql = "SELECT
                users.firstname,
                users.middlename,
                users.lastname
            FROM
                `users`
            WHERE
                users.uid = $data[1]";
                
        $response = mysqli_query($conn, $sql);
        $data = array_merge($data, mysqli_fetch_all($response)[0]);
        
        echo json_encode(array('data' => $data));
    }
}
?>
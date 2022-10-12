<?php 
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];

    $sql = "SELECT * FROM `history` WHERE `passenger_uid` = $uid OR `driver_uid` = $uid";

    $result = mysqli_query($conn, $sql);
    $data = array();

    if(mysqli_num_rows($result) > 0) {
        while (($rowData = mysqli_fetch_assoc($result)))
        {
            $dUID = $rowData['driver_uid'];
            $driverSQL = "SELECT `firstname`, `middlename`, `lastname` FROM `users` WHERE `uid` = $dUID";
            $driverInfo = mysqli_query($conn, $driverSQL);

            $tmpData = array_merge($rowData, mysqli_fetch_assoc($driverInfo));
            
            $data[$rowData['timestamp']] = $tmpData;
        }
    }

    echo json_encode(array('data' => $data));
}
?>
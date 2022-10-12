<?php 
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];

    $sql = "SELECT * FROM `balance_history` WHERE `sender` = $uid OR `receiver` = $uid";

    $result = mysqli_query($conn, $sql);
    $data = array();

    if(mysqli_num_rows($result) > 0) {
        while (($rowData = mysqli_fetch_assoc($result)))
        {
            $receiver = array();
            $sender = array();

            $recUID = $rowData['receiver'];
            $recSQL = "SELECT `firstname`, `middlename`, `lastname` FROM `users` WHERE `uid` = $recUID";
            $recInfo = mysqli_query($conn, $recSQL);
            $receiver = mysqli_fetch_assoc($recInfo);

            if($rowData['type'] == 0) {
                $senUID = $rowData['sender'];
                $senSQL = "SELECT `firstname`, `middlename`, `lastname` FROM `users` WHERE `uid` = $senUID";
                $senInfo = mysqli_query($conn, $senSQL);
                $sender = mysqli_fetch_assoc($senInfo);
                $rowData['senderData'] = $sender;
            }
            
            $rowData['receiverData'] = $receiver;
            
            $data[$rowData['timestamp']] = $rowData;
        }
    }

    echo json_encode(array('data' => $data));
}
?>
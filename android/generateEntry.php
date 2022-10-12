<?php
include '../modules/connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $driver = $_POST['driver'];
    $passenger = $_POST['passenger'];
    $amount = $_POST['amount'];
    $distance = $_POST['distance'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];

    $ts = time();

    $sql = "INSERT INTO `history`(
        `timestamp`
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

    echo json_encode(array('success' => 'History Entry has been recorded.'));
}
?>
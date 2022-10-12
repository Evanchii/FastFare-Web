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

    $fName = validate($_POST['fname']); 
    $mName = validate($_POST['mname']); 
    $lName = validate($_POST['lname']); 
    $address = validate($_POST['address']); 
    $bday = validate($_POST['bday']); 
    $cno = validate($_POST['contact']); 
    $email = validate($_POST['email']); 
    $pass = hash_hmac('sha512', 'salt' . validate($_POST['password']), 'thisIsAVeryRandomKeyUwU');

    $sql = "SELECT * FROM authentication WHERE email='$email' OR contact='$cno'";

    $result = mysqli_query($conn, $sql);
  
    if (mysqli_num_rows($result) <= 0) {
        $sql = "INSERT INTO `authentication`(
            `uid`,
            `type`,
            `contact`,
            `email`,
            `password`
        )
        VALUES(
            NULL,
            0,
            '$cno',
            '$email',
            '$pass'
        )";

        $result = mysqli_query($conn, $sql);

        $uid =  $conn-> insert_id;

        $sql = "INSERT INTO `users`(
            `uid`,
            `firstname`,
            `middlename`,
            `lastname`,
            `address`,
            `birthday`
        )
        VALUES(
            $uid,
            '$fName',
            '$mName',
            '$lName',
            '$address',
            '$bday'
        )";

        $result = mysqli_query($conn, $sql);

        echo json_encode(array('success' => 'User has been registered'));
    }else{
        echo json_encode(array('error' => 'Email or Contact Number has already been taken'));
    }
}
?>
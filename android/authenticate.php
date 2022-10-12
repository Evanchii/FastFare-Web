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
    $email = validate($_POST['email']);
    $pass = hash_hmac('sha512', 'salt' . validate($_POST['password']), 'thisIsAVeryRandomKeyUwU');

    if (empty($email)) {
		echo json_encode(array('error' => 'Email Address is Empty'));
	}else if(empty($pass)){
        echo json_encode(array('error' => 'Password is Empty'));
	}else{
		$sql = "SELECT * FROM authentication WHERE email='$email' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (gettype($result) != 'boolean') {
            if(mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['email'] === $email && $row['password'] === $pass) {
                    $uid = $row['uid'];
                    $type = $row['type'];
                    
                    $sql = "SELECT users.discount FROM users WHERE `uid` = '$uid'";
                    $result = mysqli_query($conn, $sql);
                    
                    $discount = 100;
                    if(mysqli_num_rows($result) > 0) {
                        $discount = mysqli_fetch_all($result)[0][0];
                    }
                    echo json_encode(array('user' => $uid, 'type' => $type, 'discount' => $discount));
                }else{
                    echo json_encode(array('error' => 'Incorrect Email or Password'));
                }
            }else{
                echo json_encode(array('error' => 'Incorrect Email or Password'));
            }
		}else{
            echo json_encode(array('error' => 'Incorrect Email or Password'));
		}
	}
}
?>
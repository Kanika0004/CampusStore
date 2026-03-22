<?php
session_start();
include "../../backend/db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");

if(mysqli_num_rows($result) > 0){

$admin = mysqli_fetch_assoc($result);

if(password_verify($password, $admin['password'])){

$_SESSION['admin_logged_in'] = true;
$_SESSION['admin_email'] = $admin['email'];

echo json_encode(["status"=>"success"]);

}else{
echo json_encode(["status"=>"error"]);
}

}else{
echo json_encode(["status"=>"error"]);
}
?>
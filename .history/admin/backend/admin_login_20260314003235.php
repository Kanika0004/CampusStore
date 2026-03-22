<?php

session_start();
include "../../backend/db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result) > 0){

$_SESSION['admin'] = true;

echo json_encode(["status"=>"success"]);

}else{

echo json_encode(["status"=>"error"]);

}

?>
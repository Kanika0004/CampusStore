<?php
header("Content-Type: application/json");

include "../../backend/db.php";

// prevent warnings breaking JSON
error_reporting(0);

if(!isset($_POST['password'])){
    echo json_encode(["status"=>"error","msg"=>"no password"]);
    exit();
}

$password = $_POST['password'];

// hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE admin SET password='$hashedPassword' WHERE id=1";

if(mysqli_query($conn, $sql)){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error","msg"=>"db failed"]);
}
?>
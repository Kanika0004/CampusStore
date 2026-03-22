<?php
header("Content-Type: application/json");
include "../../backend/db.php";

// optional: avoid notices breaking JSON
error_reporting(0);

if(!isset($_POST['password'])){
    echo json_encode(["status"=>"error"]);
    exit();
}

$password = $_POST['password'];

// ❗ plain text (no hashing)
$sql = "UPDATE admin SET password='$password' WHERE id=1";

if(mysqli_query($conn, $sql)){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error"]);
}
?>
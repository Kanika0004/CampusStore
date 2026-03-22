<?php
header("Content-Type: application/json");
include "../../backend/db.php";

// prevent warnings breaking JSON
error_reporting(0);

if(!isset($_POST['name']) || !isset($_POST['email'])){
    echo json_encode(["status"=>"error"]);
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];

$sql = "UPDATE admin SET name='$name', email='$email' WHERE id=1";

if(mysqli_query($conn, $sql)){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error"]);
}
?>
<?php
header("Content-Type: application/json");

include "../../backend/db.php";

$password = $_POST['password'];

// 🔥 hash password (IMPORTANT)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE admin SET password='$hashedPassword' WHERE id=1";

if(mysqli_query($conn, $sql)){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error"]);
}
?>
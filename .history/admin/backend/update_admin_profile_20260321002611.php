<?php
header("Content-Type: application/json");

include "../../backend/db.php";

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

$query = "UPDATE admin 
SET name='$name', email='$email'
WHERE id=1";

if(mysqli_query($conn, $query)){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error"]);
}
?>
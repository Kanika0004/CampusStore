<?php
header("Content-Type: application/json");
include "../../backend/db.php";

$cod = mysqli_real_escape_string($conn, $_POST['cod']);
$upi = mysqli_real_escape_string($conn, $_POST['upi']);
$gateway = mysqli_real_escape_string($conn, $_POST['gateway']);

$sql = "UPDATE settings SET 
cod='$cod',
upi='$upi',
gateway='$gateway'
WHERE id=1";

if(mysqli_query($conn, $sql)){
echo json_encode(["status"=>"success"]);
}else{
echo json_encode(["status"=>"error"]);
}
?>
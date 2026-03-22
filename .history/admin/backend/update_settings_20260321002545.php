<?php
header("Content-Type: application/json");

include "../../backend/db.php";

$name = mysqli_real_escape_string($conn, $_POST['website_name']);
$email = mysqli_real_escape_string($conn, $_POST['support_email']);
$phone = mysqli_real_escape_string($conn, $_POST['contact_phone']);

$sql = "UPDATE settings SET 
website_name='$name',
support_email='$email',
contact_phone='$phone'
WHERE id=1";

if(mysqli_query($conn, $sql)){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error"]);
}
?>
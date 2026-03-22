<?php


include "../../backend/db.php"; // your DB connection

$id = $_POST['id'];
$reply = $_POST['reply'];

// update enquiry
$sql = "UPDATE enquiries 
        SET admin_reply='$reply', status='Replied' 
        WHERE id=$id";

if(mysqli_query($conn, $sql)){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error"]);
}
?>
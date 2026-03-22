<?php

include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$query = "INSERT INTO enquiries (name,email,message)
VALUES ('$name','$email','$message')";

if(mysqli_query($conn,$query)){

echo json_encode(["status"=>"success"]);

}else{

echo json_encode(["status"=>"error"]);

}

?>
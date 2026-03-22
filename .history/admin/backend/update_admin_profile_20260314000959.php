<?php

include "../../backend/db.php";

$name = $_POST['name'];
$email = $_POST['email'];

$query = "UPDATE admin 
SET name='$name', email='$email'
WHERE id=1";

if(mysqli_query($conn,$query)){
echo json_encode(["status"=>"success"]);
}else{
echo json_encode(["status"=>"error"]);
}

?>
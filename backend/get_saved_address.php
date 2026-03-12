<?php

session_start();
include "db.php";

header("Content-Type: application/json");

if(!isset($_SESSION['user_id'])){
echo json_encode(["status"=>"error"]);
exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM addresses 
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 1";

$result = $conn->query($sql);

if($result->num_rows > 0){
$row = $result->fetch_assoc();
echo json_encode($row);
}else{
echo json_encode([]);
}

?>
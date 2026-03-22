<?php

include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$product_id = $data["product_id"];
$user_name = $data["user_name"];
$rating = $data["rating"];
$comment = $data["comment"];

$stmt = $conn->prepare("INSERT INTO reviews (product_id,user_name,rating,comment) VALUES (?,?,?,?)");

$stmt->bind_param("isis",$product_id,$user_name,$rating,$comment);

if($stmt->execute()){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error"]);
}

?>
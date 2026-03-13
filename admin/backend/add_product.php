<?php

include "../../backend/db.php";

$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];

$sql = "INSERT INTO products (name, price, image, category, subcategory)
VALUES ('$name','$price','$image','$category','$subcategory')";

if($conn->query($sql)){
echo json_encode(["status"=>"success"]);
} else {
echo json_encode(["status"=>"error"]);
}

?>
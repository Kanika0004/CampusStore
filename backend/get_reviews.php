<?php

include "db.php";

$product_id = $_GET["product_id"];

$result = $conn->query("SELECT * FROM reviews WHERE product_id=$product_id ORDER BY created_at DESC");

$reviews = [];

while($row = $result->fetch_assoc()){
    $reviews[] = $row;
}

echo json_encode($reviews);

?>
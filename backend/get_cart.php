<?php

header("Content-Type: application/json");

$conn = new mysqli("localhost","root","","campusstore");

$user_id = 1;

$sql = "SELECT products.name, products.price, cart.quantity
FROM cart
INNER JOIN products
ON cart.product_id = products.id
WHERE cart.user_id = $user_id";

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
$data[] = $row;
}

echo json_encode($data);

?>
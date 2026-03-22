<?php
header("Content-Type: application/json");

session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.id, products.name, products.price, products.image, cart.quantity
        FROM cart
        INNER JOIN products
        ON cart.product_id = products.id
        WHERE cart.user_id = $user_id";

$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
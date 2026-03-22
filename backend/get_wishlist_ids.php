<?php
session_start();
include "db.php";

header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT product_id FROM wishlist WHERE user_id = '$user_id'";
$result = $conn->query($sql);

$ids = [];

while ($row = $result->fetch_assoc()) {
    $ids[] = (int)$row['product_id'];
}

echo json_encode($ids);
?>
<?php
session_start();
include "db.php";

header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$product_id = isset($data['product_id']) ? intval($data['product_id']) : 0;
$user_id = $_SESSION['user_id'];

if ($product_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid product"]);
    exit();
}

$check = $conn->query("SELECT id FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'");

if ($check && $check->num_rows > 0) {
    $conn->query("DELETE FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'");
    echo json_encode(["status" => "removed"]);
} else {
    $conn->query("INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')");
    echo json_encode(["status" => "added"]);
}
?>
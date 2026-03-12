<?php
session_start();
header("Content-Type: application/json");
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        "status" => "error",
        "message" => "User not logged in"
    ]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$product_id = isset($data['product_id']) ? intval($data['product_id']) : 0;
$quantity   = isset($data['quantity']) ? intval($data['quantity']) : 1;
$user_id    = $_SESSION['user_id'];

if ($product_id <= 0 || $quantity <= 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid product or quantity"
    ]);
    exit();
}

// If product already in cart → increase quantity
$check = $conn->query("SELECT id, quantity FROM cart 
                       WHERE user_id = $user_id AND product_id = $product_id");

if ($check && $check->num_rows > 0) {
    $row = $check->fetch_assoc();
    $newQty = $row['quantity'] + $quantity;

    $conn->query("UPDATE cart SET quantity = $newQty WHERE id = " . $row['id']);
} else {
    $conn->query("INSERT INTO cart (user_id, product_id, quantity)
                  VALUES ($user_id, $product_id, $quantity)");
}

echo json_encode(["status" => "success"]);
?>
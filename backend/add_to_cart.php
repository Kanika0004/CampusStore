<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$product_id = intval($data['product_id']);
$quantity   = intval($data['quantity']);
$user_id    = 1; // temporary until login/session is added

// If product already in cart → increase quantity
$check = $conn->query("SELECT id, quantity FROM cart 
                       WHERE user_id=$user_id AND product_id=$product_id");

if($check && $check->num_rows > 0){
  $row = $check->fetch_assoc();
  $newQty = $row['quantity'] + $quantity;

  $conn->query("UPDATE cart SET quantity=$newQty WHERE id=".$row['id']);
} else {
  $conn->query("INSERT INTO cart (user_id, product_id, quantity)
                VALUES ($user_id, $product_id, $quantity)");
}

echo json_encode(["status"=>"success"]);
?>
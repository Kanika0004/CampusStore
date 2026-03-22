<?php
session_start();
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$action = $data['action'];
$user_id = $_SESSION['user_id'];

// get product id
$res = $conn->query("SELECT id FROM products WHERE name='$name'");
$row = $res->fetch_assoc();
$product_id = $row['id'];

if ($action == "increase") {
    $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id='$user_id' AND product_id='$product_id'");
}

if ($action == "decrease") {
    $conn->query("UPDATE cart SET quantity = quantity - 1 WHERE user_id='$user_id' AND product_id='$product_id' AND quantity > 1");
}

if ($action == "remove") {
    $conn->query("DELETE FROM cart WHERE user_id='$user_id' AND product_id='$product_id'");
}
?>
<?php

include "../../backend/db.php";

$data = [];

/* -------- TOTAL PRODUCTS -------- */

$result = $conn->query("SELECT COUNT(*) AS total FROM products");
$row = $result->fetch_assoc();
$data["products"] = $row["total"];


/* -------- TOTAL ORDERS -------- */

$result = $conn->query("SELECT COUNT(*) AS total FROM orders");
$row = $result->fetch_assoc();
$data["orders"] = $row["total"];


/* -------- TOTAL USERS -------- */

$result = $conn->query("SELECT COUNT(*) AS total FROM users");
$row = $result->fetch_assoc();
$data["users"] = $row["total"];


/* -------- TOTAL REVENUE -------- */

$result = $conn->query("SELECT SUM(total) AS revenue FROM orders");
$row = $result->fetch_assoc();

$data["revenue"] = $row["revenue"] ?? 0;


/* -------- RECENT ORDERS -------- */

$sql = "
SELECT orders.id,
users.name,
orders.total,
orders.created_at
FROM orders
JOIN users
ON orders.user_id = users.id
ORDER BY orders.created_at DESC
LIMIT 5
";

$result = $conn->query($sql);

$recent = [];

while($row = $result->fetch_assoc()){
$recent[] = $row;
}

$data["recent_orders"] = $recent;


/* -------- RETURN JSON -------- */

header("Content-Type: application/json");

echo json_encode($data);

?>
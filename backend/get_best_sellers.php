<?php
include "db.php";

$sql = "SELECT * FROM products WHERE popular = 1 LIMIT 10";
$result = $conn->query($sql);

$products = [];

while($row = $result->fetch_assoc()){
    $products[] = $row;
}

header("Content-Type: application/json");
echo json_encode($products);
?>
<?php
include "db.php";
header("Content-Type: application/json");

$offer = isset($_GET['offer']) ? trim($_GET['offer']) : '';

$sql = "";
$result = null;

switch ($offer) {
    case "99":
        $sql = "SELECT * FROM products WHERE price <= 99 ORDER BY price ASC";
        break;

    case "week":
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
        break;

    case "bulk":
        $sql = "SELECT * FROM products 
                WHERE subcategory IN ('Notebooks', 'Pens', 'Files')
                   OR category = 'Stationery'
                ORDER BY price ASC";
        break;

    case "combo":
        $sql = "SELECT * FROM products 
                WHERE category IN ('Electronics', 'Accessories', 'Stationery')
                ORDER BY RAND() LIMIT 8";
        break;

    default:
        echo json_encode([]);
        exit();
}

$result = $conn->query($sql);

$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>
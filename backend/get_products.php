<?php
include "db.php";

$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";
$category = isset($_GET["category"]) ? trim($_GET["category"]) : "";
$subcategory = isset($_GET["subcategory"]) ? trim($_GET["subcategory"]) : "";

$sql = "SELECT * FROM products WHERE 1=1";
$params = [];
$types = "";

if ($search !== "") {
    $sql .= " AND (name LIKE ? OR category LIKE ? OR subcategory LIKE ?)";
    $searchTerm = "%" . $search . "%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= "sss";
}

if ($category !== "" && $category !== "All") {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

if ($subcategory !== "" && $subcategory !== "All") {
    $sql .= " AND subcategory = ?";
    $params[] = $subcategory;
    $types .= "s";
}

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

header("Content-Type: application/json");
echo json_encode($products);
?>
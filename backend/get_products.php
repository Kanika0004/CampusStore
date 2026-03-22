<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'db.php';

$search      = isset($_GET['search'])      ? trim($_GET['search'])      : '';
$category    = isset($_GET['category'])    ? trim($_GET['category'])    : 'All';
$subcategory = isset($_GET['subcategory']) ? trim($_GET['subcategory']) : 'All';
$min_price   = isset($_GET['min_price'])   ? intval($_GET['min_price']) : 0;
$max_price   = isset($_GET['max_price'])   ? intval($_GET['max_price']) : 999999;
$sort        = isset($_GET['sort'])        ? trim($_GET['sort'])        : 'default';

$query  = "SELECT * FROM products WHERE 1=1";
$params = [];
$types  = '';

// Search filter
if (!empty($search)) {
    $query   .= " AND (name LIKE ? OR category LIKE ? OR subcategory LIKE ?)";
    $s        = "%$search%";
    $params[] = $s;
    $params[] = $s;
    $params[] = $s;
    $types   .= 'sss';
}

// Category filter
if ($category !== 'All') {
    $query   .= " AND category = ?";
    $params[] = $category;
    $types   .= 's';
}

// Subcategory filter
if ($subcategory !== 'All') {
    $query   .= " AND subcategory = ?";
    $params[] = $subcategory;
    $types   .= 's';
}

// Price range filter
$query   .= " AND price >= ? AND price <= ?";
$params[] = $min_price;
$params[] = $max_price;
$types   .= 'ii';

// Sorting
switch ($sort) {
    case 'price_asc':  $query .= " ORDER BY price ASC";  break;
    case 'price_desc': $query .= " ORDER BY price DESC"; break;
    case 'newest':     $query .= " ORDER BY id DESC";    break;
    case 'name_asc':   $query .= " ORDER BY name ASC";   break;
    default:           $query .= " ORDER BY id ASC";     break;
}

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result   = $stmt->get_result();
$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>
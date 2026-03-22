<?php
include "db.php";
header("Content-Type: application/json");

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
    echo json_encode([]);
    exit();
}

$q = strtolower($q);

$sql = "SELECT id, name, image, category
        FROM products
        ORDER BY name ASC";

$result = $conn->query($sql);

$data = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $name = strtolower($row['name']);

        // split product name into words
        $words = preg_split('/\s+/', $name);

        $matched = false;

        foreach ($words as $word) {
            if (strpos($word, $q) === 0) {
                $matched = true;
                break;
            }
        }

        if ($matched) {
            $data[] = $row;
        }

        if (count($data) >= 8) {
            break;
        }
    }
}

echo json_encode($data);
?>
<?php
include "db.php";

$sql = "SELECT DATE(created_at) as date, SUM(total) as revenue
        FROM orders
        WHERE created_at >= CURDATE() - INTERVAL 7 DAY
        GROUP BY DATE(created_at)
        ORDER BY date";

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
$data[] = [
"date" => $row["date"],
"revenue" => $row["revenue"]
];
}

echo json_encode($data);
?>
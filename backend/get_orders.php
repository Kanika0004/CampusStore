<?php

include "db.php";

$sql = "SELECT orders.*, users.name 
FROM orders
JOIN users ON orders.user_id = users.id
ORDER BY created_at DESC";

$result = $conn->query($sql);

$data=[];

while($row=$result->fetch_assoc()){
$data[]=$row;
}

echo json_encode($data);

?>
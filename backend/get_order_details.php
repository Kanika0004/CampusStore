<?php

include "db.php";

$id=$_GET["id"];

$sql="SELECT orders.*, users.name, users.email
FROM orders
JOIN users ON orders.user_id = users.id
WHERE orders.id='$id'";

$result=$conn->query($sql);

$row=$result->fetch_assoc();

echo json_encode($row);

?>
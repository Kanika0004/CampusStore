<?php
header("Content-Type: application/json");

include "../../backend/db.php";

$result = mysqli_query($conn, "SELECT * FROM settings LIMIT 1");

$row = mysqli_fetch_assoc($result);

echo json_encode($row);
?>
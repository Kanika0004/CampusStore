<?php

include "../../backend/db.php";

$query = "SELECT * FROM enquiries ORDER BY created_at DESC";
$result = mysqli_query($conn,$query);

$data = [];

while($row = mysqli_fetch_assoc($result)){
$data[] = $row;
}

echo json_encode($data);

?>
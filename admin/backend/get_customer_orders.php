<?php

include "../../backend/db.php";

$user_id = $_GET['user_id'];

$query = "SELECT * FROM orders WHERE user_id=$user_id";

$result = mysqli_query($conn,$query);

$orders = [];

while($row = mysqli_fetch_assoc($result)){
$orders[] = $row;
}

echo json_encode($orders);

?>
<?php

include "../../backend/db.php";

$query = "SELECT id,name,email FROM users";
$result = mysqli_query($conn,$query);

$customers = [];

while($row = mysqli_fetch_assoc($result)){
    $customers[] = $row;
}

echo json_encode($customers);

?>
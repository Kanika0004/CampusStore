<?php

include "../../backend/db.php";

$query = "SELECT name,email FROM admin WHERE id=1";

$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);

echo json_encode($row);

?>
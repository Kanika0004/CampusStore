<?php

include "db.php";

$id=$_POST["id"];
$status=$_POST["status"];

$sql="UPDATE orders SET status='$status' WHERE id='$id'";

$conn->query($sql);

echo json_encode(["status"=>"success"]);

?>
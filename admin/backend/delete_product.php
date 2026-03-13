<?php

include "../../backend/db.php";

$id = $_POST['id'];

$sql = "DELETE FROM products WHERE id=$id";

if($conn->query($sql)){
echo json_encode(["status"=>"success"]);
} else {
echo json_encode(["status"=>"error"]);
}

?>
<?php


include "../../backend/db.php"; // adjust path if needed

$id = $_POST['id'];

// delete query
$sql = "DELETE FROM enquiries WHERE id = $id";

if(mysqli_query($conn, $sql)){
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>
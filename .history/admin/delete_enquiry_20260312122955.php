<?php
include "../backend/db.php";

$id = $_GET['id'];

$query = "DELETE FROM enquiries WHERE id=$id";
mysqli_query($conn, $query);

header("Location: enquiries.php");
?>

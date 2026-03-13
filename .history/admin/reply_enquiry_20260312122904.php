<?php
include "../backend/db.php";

$id = $_POST['id'];
$reply = $_POST['reply'];

$query = "UPDATE enquiries
SET admin_reply='$reply', status='Resolved'
WHERE id=$id";

mysqli_query($conn, $query);

header("Location: enquiries.php");
?>

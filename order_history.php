<?php
session_start();
include "backend/db.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.html");
exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT id,total,payment_method,created_at 
FROM orders 
WHERE user_id=$user_id 
ORDER BY created_at DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>

<head>
<title>My Orders</title>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
<body class="bg-light">
<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">
<h2 class="fw-bold">My Orders</h2>
<a href="index.html" class="btn btn-outline-primary">Continue Shopping</a>
</div>
<div class="row g-4">

<?php

while($row = $result->fetch_assoc()){

echo "
<div class='col-md-6'>
<div class='card shadow-sm border-0'>
<div class='card-body'>

<div class='d-flex justify-content-between'>
<h5 class='fw-bold'>Order #{$row['id']}</h5>
<span class='text-muted'>".date("d M Y", strtotime($row['created_at']))."</span>
</div>

<hr>

<p class='mb-1'><strong>Payment:</strong> {$row['payment_method']}</p>
<p class='mb-2'><strong>Total:</strong> ₹{$row['total']}</p>

<span class='badge bg-warning text-dark'>Processing</span>

<div class='mt-3'>
<a href='#' class='btn btn-outline-primary btn-sm'>View Details</a>
</div>

</div>
</div>
</div>
";

}

?>

</div>

</div>
<script src="js/cart.js"></script>
</body>
</html>
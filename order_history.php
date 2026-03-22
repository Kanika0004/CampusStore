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

<style>
body {
  background: #f8fbff;
}

/* Order Card */
.order-card {
  border-radius: 20px;
  background: #fff;
  transition: 0.25s;
  box-shadow: 0 10px 25px rgba(15,23,42,0.05);
}

.order-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(15,23,42,0.1);
}

/* Status badge */
.status-badge {
  padding: 6px 12px;
  border-radius: 999px;
  font-size: 0.75rem;
  font-weight: 700;
  background: #fef3c7;
  color: #92400e;
}

/* Title spacing */
h2 {
  letter-spacing: -0.02em;
}

/* Button */
.btn-outline-primary {
  border-radius: 12px;
}
</style>

</head>

<body>

<div class="container mt-4">
  <div class="p-4 rounded-4 bg-white shadow-sm border">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">My Orders</h2>

      <a href="index.html" class="btn btn-outline-primary px-3">
        Continue Shopping
      </a>
    </div>

    <div class="row g-4">

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

echo "
<div class='col-md-6'>
  <div class='order-card p-4'>

    <div class='d-flex justify-content-between align-items-center mb-2'>
      <h5 class='fw-bold mb-0'>Order #{$row['id']}</h5>
      <span class='text-muted small'>".date("d M Y", strtotime($row['created_at']))."</span>
    </div>

    <hr class='my-2'>

    <p class='mb-1 text-muted'>
      <strong class='text-dark'>Payment:</strong> {$row['payment_method']}
    </p>

    <p class='mb-2 text-muted'>
      <strong class='text-dark'>Total:</strong> ₹{$row['total']}
    </p>

    <span class='status-badge'>Processing</span>

    <div class='mt-3 d-flex justify-content-between align-items-center'>
      <a href='#' class='btn btn-outline-primary btn-sm px-3 rounded-3'>
        View Details
      </a>
    </div>

  </div>
</div>
";

}

}else{
    echo "<p class='text-muted'>No orders yet.</p>";
}

?>

    </div>
  </div>
</div>

</body>
</html>
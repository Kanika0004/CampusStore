<?php

$order_id = $_GET['order_id'] ?? "";
$payment = $_GET['payment'] ?? "";
$total = $_GET['total'] ?? "";

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Order Success</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="text-center">

<h2 class="text-success">Order Placed Successfully 🎉</h2>

<p class="mt-3">Thank you for shopping with CampusStore.</p>

<div class="card p-4 mt-4 mx-auto" style="max-width:500px">

<h5>Order Details</h5>

<p><strong>Order ID:</strong> #<?php echo $order_id; ?></p>

<p><strong>Payment Method:</strong> <?php echo $payment; ?></p>

<p><strong>Total Amount:</strong> ₹<?php echo $total; ?></p>

<p><strong>Estimated Delivery:</strong> 3-5 Days</p>

</div>

<a href="index.html" class="btn btn-primary mt-4">Continue Shopping</a>

</div>

</div>

</body>

</html>


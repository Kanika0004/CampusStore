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

<style>
body {
  background: linear-gradient(135deg, #eef5ff, #f8fbff);
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Glass card */
.success-card {
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(12px);
  border-radius: 28px;
  padding: 40px;
  max-width: 500px;
  width: 100%;
  text-align: center;
  box-shadow: 0 20px 50px rgba(15,23,42,0.1);
}

/* Success circle */
.success-icon {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  animation: pop 0.5s ease;
}

.success-icon i {
  font-size: 40px;
  color: white;
}

/* Animation */
@keyframes pop {
  0% { transform: scale(0.6); opacity: 0; }
  100% { transform: scale(1); opacity: 1; }
}

/* Order details box */
.details-box {
  background: #f8fafc;
  border-radius: 16px;
  padding: 20px;
  margin-top: 20px;
  text-align: left;
}

/* Buttons */
.btn-primary {
  border-radius: 14px;
  padding: 10px 20px;
  font-weight: 600;
}

.btn-outline-secondary {
  border-radius: 14px;
  padding: 10px 20px;
}
</style>

<!-- Bootstrap icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

<div class="success-card">

  <!-- Icon -->
  <div class="success-icon">
    <i class="bi bi-check-lg"></i>
  </div>

  <!-- Title -->
  <h2 class="fw-bold text-success">Order Confirmed!</h2>

  <p class="text-muted">
    Your order has been placed successfully 🎉  
    Sit back and relax, we’ll take care of the rest.
  </p>

  <!-- Order details -->
  <div class="details-box">
    <p class="mb-2"><strong>Order ID:</strong> #<?php echo $order_id; ?></p>
    <p class="mb-2"><strong>Payment:</strong> <?php echo $payment; ?></p>
    <p class="mb-2"><strong>Total:</strong> ₹<?php echo $total; ?></p>
    <p class="mb-0"><strong>Delivery:</strong> 3–5 Days</p>
  </div>

  <!-- Buttons -->
  <div class="mt-4 d-flex justify-content-center gap-3">
    <a href="index.html" class="btn btn-primary">
      Continue Shopping
    </a>

    <a href="order_history.php" class="btn btn-outline-secondary">
      View Orders
    </a>
  </div>

</div>

</body>
</html>
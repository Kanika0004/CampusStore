<?php
session_start();

include "backend/db.php";
if(!isset($_SESSION['user_id'])){
header("Location: login.html?redirect=checkout");
exit();
}

$user_id = $_SESSION['user_id'];
$address_sql = "SELECT * FROM addresses WHERE user_id = $user_id";
$addresses = $conn->query($address_sql);

$sql = "SELECT products.name, products.price, cart.quantity
FROM cart
JOIN products
ON cart.product_id = products.id
WHERE cart.user_id = $user_id";

$result = $conn->query($sql);

$total = 0;
?>

<!DOCTYPE html>
<html>

<head>
    

<title>Checkout</title>

<meta charset="UTF-8">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
rel="stylesheet"
/>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
rel="stylesheet"
/>
</head>

<body>
    <div class="container">
<header class="d-flex align-items-center justify-content-between py-3 mb-4 border-bottom">

<!-- Logo -->
<div class="col-md-2">
<a href="index.html" class="text-decoration-none">
<span class="fs-4 fw-bold text-primary">CampusStore</span>
</a>
</div>

<!-- Search -->
<div class="col-md-5">
<form class="d-flex">
<input type="search" class="form-control me-2"
placeholder="Search for books, gadgets, stationery...">
<button class="btn btn-primary" type="submit">Search</button>
</form>
</div>

<!-- Right Side -->
<div class="col-md-3 text-end d-flex justify-content-end align-items-center gap-2 flex-nowrap">

<a href="login.html" id="loginBtn" class="btn btn-outline-primary btn-sm">Login</a>

<a href="signup.html" id="signupBtn" class="btn btn-primary btn-sm">Sign Up</a>

<span id="userWelcome" class="fw-semibold ms-2"></span>

<a href="order_history.php" id="ordersBtn"
class="btn btn-outline-info" style="display:none">
My Orders
</a>

<a href="backend/logout.php" id="logoutBtn"
class="btn btn-outline-secondary" style="display:none">
Logout
</a>

<a href="wishlist.html" class="btn btn-outline-danger position-relative">
<i class="bi bi-heart"></i>
</a>

<a href="checkout.php" class="btn btn-outline-primary position-relative">
<i class="bi bi-cart"></i>
<span id="cartCount"
class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
0
</span>
</a>

</div>
</header>
</div>

<div class="container mt-5">

<div class="row">

<!-- LEFT SIDE FORM -->

<div class="col-md-7">


<h3>Billing Address</h3>

<form action="backend/place_order.php" method="POST">

<div class="row">

<div class="col-md-6">
<input id="first_name" class="form-control mb-3" name="first_name" placeholder="First Name" required>
</div>

<div class="col-md-6">
<input id="last_name" class="form-control mb-3" name="last_name" placeholder="Last Name" required>
</div>

</div>

<input id="email" class="form-control mb-3" name="email" placeholder="Email">

<input id="address" class="form-control mb-3" name="address" placeholder="Address">

<input id="landmark" class="form-control mb-3" name="landmark" placeholder="Landmark">

<div class="row">

<div class="col-md-4">
<input id="country" class="form-control mb-3" name="country" placeholder="Country">
</div>

<div class="col-md-4">
<input id="state" class="form-control mb-3" name="state" placeholder="State">
</div>

<div class="col-md-4">
<input id="zip" class="form-control mb-3" name="zip" placeholder="ZIP">
</div>

</div>
<h4 class="mt-4">Saved Addresses</h4>

<div class="row">

<?php while($addr = $addresses->fetch_assoc()) { ?>

<div class="col-md-6 mb-3">

<div class="card p-3 shadow-sm">

<strong><?php echo $addr['first_name'] . " " . $addr['last_name']; ?></strong>

<p class="mb-1">
<?php echo $addr['address']; ?>
</p>

<p class="mb-1">
<?php echo $addr['landmark']; ?>
</p>

<p class="mb-1">
<?php echo $addr['state']; ?>,
<?php echo $addr['country']; ?> -
<?php echo $addr['zip']; ?>
</p>

<button type="button" class="btn btn-outline-primary btn-sm useAddress"

data-first="<?php echo $addr['first_name']; ?>"
data-last="<?php echo $addr['last_name']; ?>"
data-email="<?php echo $addr['email']; ?>"
data-address="<?php echo $addr['address']; ?>"
data-landmark="<?php echo $addr['landmark']; ?>"
data-country="<?php echo $addr['country']; ?>"
data-state="<?php echo $addr['state']; ?>"
data-zip="<?php echo $addr['zip']; ?>"

>

Use this address

</button>

</div>

</div>

<?php } ?>

</div>

<h5>Payment</h5>

<input type="radio" name="payment" value="card"> Credit Card<br>
<input type="radio" name="payment" value="debit"> Debit Card<br>
<input type="radio" name="payment" value="upi"> UPI<br>
<input type="radio" name="payment" value="cod"> COD<br><br>

<button class="btn btn-primary">
Continue to Checkout
</button>

</form>

</div>


<!-- RIGHT SIDE CART -->

<div class="col-md-5">
<div class="d-flex justify-content-end mb-3">

<a href="index.html" class="btn btn-outline-secondary">
← Back to Dashboard
</a>

</div>
<div class="card p-3">

<h5>Your Cart</h5>

<?php

while($row = $result->fetch_assoc()){

$itemTotal = $row['price'] * $row['quantity'];

$total += $itemTotal;

echo "<p>
{$row['name']} (x{$row['quantity']})
<span class='float-end'>₹$itemTotal</span>
</p>";

}

?>

<hr>

<h4>Total : ₹<?php echo $total; ?></h4>

</div>

</div>

</div>

</div>
<script>

document.querySelectorAll(".useAddress").forEach(btn => {

btn.addEventListener("click", function(){

document.getElementById("first_name").value = this.dataset.first
document.getElementById("last_name").value = this.dataset.last
document.getElementById("email").value = this.dataset.email
document.getElementById("address").value = this.dataset.address
document.getElementById("landmark").value = this.dataset.landmark
document.getElementById("country").value = this.dataset.country
document.getElementById("state").value = this.dataset.state
document.getElementById("zip").value = this.dataset.zip

})

})

</script>
<script src="js/cart.js"></script>
<script src="js/navbar.js"></script>
<script>

fetch("backend/get_cart.php")
.then(res => res.json())
.then(data => {

let count = 0

data.forEach(item => {
count += parseInt(item.quantity)
})

document.getElementById("cartCount").innerText = count

})

</script>
<script>

fetch("backend/get_user.php")
.then(res => res.json())
.then(data => {

if(data.logged_in){

document.getElementById("loginBtn").style.display = "none"
document.getElementById("signupBtn").style.display = "none"

let name = data.name.split(" ")[0];
document.getElementById("userWelcome").innerText =
"Welcome, " + name

document.getElementById("logoutBtn").style.display = "inline-block"
document.getElementById("ordersBtn").style.display = "inline-block"

}

})

</script>
</body>

</html>
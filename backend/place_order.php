<?php

session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
die("User not logged in");
}

$user_id = $_SESSION['user_id'];

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$landmark = $_POST['landmark'] ?? "";
$country = $_POST['country'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$payment = $_POST['payment'];


/* ---------------- SAVE ADDRESS ---------------- */

$check = "SELECT * FROM addresses 
WHERE user_id='$user_id'
AND address='$address'
AND zip='$zip'";

$result = $conn->query($check);

if($result->num_rows == 0){

$sql = "INSERT INTO addresses
(user_id,first_name,last_name,email,address,landmark,country,state,zip)
VALUES
('$user_id','$first_name','$last_name','$email','$address','$landmark','$country','$state','$zip')";

$conn->query($sql);

}


/* ---------------- CALCULATE TOTAL ---------------- */

$total = 0;

$sql = "SELECT products.price, cart.quantity
FROM cart
JOIN products
ON cart.product_id = products.id
WHERE cart.user_id = $user_id";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
$total += $row['price'] * $row['quantity'];
}


/* ---------------- CREATE ORDER ---------------- */

$insert = "
INSERT INTO orders (user_id,total,payment_method,address)
VALUES ('$user_id','$total','$payment','$address')
";

if(!$conn->query($insert)){
die($conn->error);
}

$order_id = $conn->insert_id;


/* ---------------- CLEAR CART ---------------- */

$conn->query("DELETE FROM cart WHERE user_id='$user_id'");


/* ---------------- REDIRECT ---------------- */

header("Location: ../order_success.php?order_id=$order_id&payment=$payment&total=$total");

?>
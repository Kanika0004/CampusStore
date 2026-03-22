<?php

session_start();

include "db.php";

$user_id = $_SESSION['user_id'];

$first = $_POST['first_name'];
$last = $_POST['last_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$landmark = $_POST['landmark'];
$country = $_POST['country'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$payment = $_POST['payment'];

$check = "SELECT * FROM addresses 
WHERE user_id='$user_id'
AND address='$address'
AND zip='$zip'";

$result = $conn->query($check);

if($result->num_rows == 0){

$sql = "INSERT INTO addresses
(user_id,first_name,last_name,email,address,landmark,country,state,zip)
VALUES
('$user_id','$first','$last','$email','$address','$landmark','$country','$state','$zip','$payment')";

$conn->query($sql);

}
echo "Address Saved";

?>
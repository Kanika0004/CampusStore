<?php

session_start();
include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

/* Insert user */

$sql = "INSERT INTO users(name,email,password)
VALUES('$name','$email','$password')";

if($conn->query($sql)){

/* Get the new user id */

$user_id = $conn->insert_id;

/* Create session */

$_SESSION['user_id'] = $user_id;

/* Go directly to checkout */

header("Location: ../checkout.php");
exit();

}

echo "Error creating account";

?>
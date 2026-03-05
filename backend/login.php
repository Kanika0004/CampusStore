<?php

session_start();
include "db.php";

$email = $_POST['email'];
$password = $_POST['password'];
$redirect = $_POST['redirect'] ?? "";

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows > 0){

$user = $result->fetch_assoc();

if($password == $user['password']){

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];

if($redirect == "checkout"){
header("Location: ../checkout.php");
} else {
header("Location: ../index.html");
}

exit();

}

}

echo "Invalid login";

?>
<?php

session_start();
include "db.php";

// get inputs safely
$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";
$redirect = $_POST['redirect'] ?? "";

/* -------- ADMIN LOGIN -------- */

$sql_admin = "SELECT * FROM admin WHERE email='$email'";
$result_admin = $conn->query($sql_admin);

if($result_admin && $result_admin->num_rows > 0){

    $admin = $result_admin->fetch_assoc();

    // plain text password check
    if($password == $admin['password']){

        $_SESSION["admin"] = true;
        $_SESSION["admin_email"] = $admin['email'];

        header("Location: ../admin/dashboard.html");
        exit();
    }
}

/* -------- USER LOGIN -------- */

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if($result && $result->num_rows > 0){

    $user = $result->fetch_assoc();

    // plain text password check
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
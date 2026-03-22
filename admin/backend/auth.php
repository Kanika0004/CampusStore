<?php
session_start();

if(!isset($_SESSION['admin_logged_in'])){
    echo json_encode(["status"=>"unauthorized"]);
    exit();
}
?>
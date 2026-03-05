<?php

$conn = new mysqli("localhost","root","","campusstore");

if($conn->connect_error){
    die("Connection Failed");
}

?>
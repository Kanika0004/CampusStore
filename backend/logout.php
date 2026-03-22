<?php

session_start();

/* destroy session */

session_unset();
session_destroy();

/* go to homepage */
echo "<script>localStorage.removeItem('cartCount');</script>";
header("Location: ../index.html");
exit();

?>
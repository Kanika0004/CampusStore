<?php

session_start();

/* destroy session */

session_unset();
session_destroy();

/* go to homepage */

header("Location: ../index.html");
exit();

?>
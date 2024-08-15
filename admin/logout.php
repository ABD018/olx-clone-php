<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page or home page
header("Location: ../clasifico/login.php"); // Change this to the actual login page URL
exit();
?>

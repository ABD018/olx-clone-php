<?php
session_start();
session_unset();
session_destroy();

// Redirect to the homepage or login page
header('Location: index.php');
exit();
?>

<?php
require_once '../admin/controllers/AdminController.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: unauthorised.php');
    exit(); // Make sure to exit after redirecting
} else {
    $controller = new AdminController();
    $controller->handleRequest();
}
?>

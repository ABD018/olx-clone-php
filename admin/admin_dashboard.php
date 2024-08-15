<?php
require_once '../admin/models/AdminModel.php';
$adminModel = new AdminModel();

// Fetch data
$dashboardData = $adminModel->getDashboardStats();
$newsData = $adminModel->getNews();
$categoriesData = $adminModel->getCategories();
$eventsData = $adminModel->getEvents(); // Fetch events for calendar

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin_styles.css">
</head>
<body>
    <div class="main-container">
        <?php include 'left-sidebar.php'; ?>
        <?php include 'main-container.php'; ?>
        <?php include 'right-sidebar.php'; ?>
    </div>
</body>
</html>

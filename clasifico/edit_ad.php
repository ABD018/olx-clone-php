<?php
include 'userprofile.php';
require_once './Models/func.php';
header('Content-Type: application/json');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Debugging: Log received form data
error_log('Received POST data:');
error_log('ad_id: ' . ($_POST['ad_id'] ?? ''));
error_log('title: ' . ($_POST['title'] ?? ''));
error_log('description: ' . ($_POST['description'] ?? ''));
error_log('price: ' . ($_POST['price'] ?? ''));
error_log('location: ' . ($_POST['location'] ?? ''));

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_ad'])) {
    $ad_id = $_POST['ad_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];

    // Update the ad in the database
    $update_success = updateAd($ad_id, $title, $description, $price, $location);
    
    // Log update success status
    error_log('Update success: ' . ($update_success ? 'true' : 'false'));

    // Return JSON response
    if ($update_success) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Ad updated successfully',
            'id' => $ad_id,
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'location' => $location
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update ad']);
    }
    exit;
}
?>

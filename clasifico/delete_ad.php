<?php
include 'userprofile.php';
require_once './Models/func.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_id = $_POST['ad_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];

    // Validate inputs
    if (empty($title) || empty($description) || empty($price) || empty($location)) {
        $message = "All fields are required!";
    } else {
        // Update the ad in the database
        $update_success = updateAd($ad_id, $title, $description, $price, $location);

        if ($update_success) {
            // Update the UI (AJAX response)
            echo json_encode([
                'status' => 'success',
                'message' => 'Ad updated successfully',
                'ad_id' => $ad_id,
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'location' => $location
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update ad']);
        }
    }
    exit;
}
?>

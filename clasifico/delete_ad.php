<?php
include 'userprofile.php';
require_once './Models/func.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_id = $_POST['ad_id'];

    // Delete the ad from the database
    $delete_success = deleteAd($ad_id, $user_id);

    if ($delete_success) {
        // Return a successful response
        echo json_encode(['status' => 'success', 'message' => 'Ad deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete ad']);
    }
    exit;
}
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'Models/func.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user details
$user_id = $_SESSION['user_id'];
$user = getUserById($user_id);

if (!$user) {
    header('Location: login.php');
    exit();
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $errors = [];

    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($errors)) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $user_id);

        if ($stmt->execute()) {
            $message = 'Profile updated successfully!';
        } else {
            $errors[] = 'Error updating profile.';
        }

        $conn->close();
    }
}

// Handle photo upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile-photo'])) {
    $photo = $_FILES['profile-photo'];
    $uploadDir = 'assets/images/profiles/';
    $uploadFile = $uploadDir . basename($photo['name']);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    if (in_array($photo['type'], $allowedTypes) && $photo['size'] <= 2 * 1024 * 1024) { // Limit size to 2MB
        if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
            $db = new Database();
            $conn = $db->getConnection();

            $sql = "UPDATE users SET profile_photo = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $uploadFile, $user_id);

            if ($stmt->execute()) {
                $user['profile_photo'] = $uploadFile; // Update user data to reflect new photo
                $_SESSION['profile_photo'] = $uploadFile; // Save the photo path in session
                $message = 'Profile photo updated successfully!';
            } else {
                $errors[] = 'Error updating profile photo.';
            }

            $conn->close();
        } else {
            $errors[] = 'Error uploading file.';
        }
    } else {
        $errors[] = 'Invalid file type or file size too large.';
    }
}

// In userController.php

// Check the action and call the appropriate function
$action = isset($_GET['action']) ? $_GET['action'] : '';
if ($action === 'getAds') {
    $ads = getFeaturedAds(); // Function to fetch ads from the database
    $response = [];
    foreach ($ads as $ad) {
        $response[] = [
            'title' => $ad['title'],
            'description' => $ad['description'],
            'adImageUrl' => $ad['image'], // Adjust this if the URL path is different
            'authorImageUrl' => $ad['author_image'],
            'authorName' => $ad['author_name'],
            'authorRole' => $ad['author_role'],
            'timeAgo' => $ad['time_ago']
        ];
    }
    echo json_encode(['success' => true, 'ads' => $response]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['referenceImages'])) {
    $adTitle = trim($_POST['adTitle'] ?? '');
    $adDescription = trim($_POST['adDescription'] ?? '');
    $adLocation = trim($_POST['adLocation'] ?? '');
    $adPrice = trim($_POST['adPrice'] ?? '');
    $referenceImages = $_FILES['referenceImages'];
    
    $errors = [];

    // Validate and move reference images
    $uploadDir = 'assets/images/ads/';
    $imagePaths = [];
    foreach ($referenceImages['tmp_name'] as $index => $tmpName) {
        $imageName = basename($referenceImages['name'][$index]);
        $uploadFile = $uploadDir . $imageName;
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($referenceImages['type'][$index], $allowedTypes) && $referenceImages['size'][$index] <= 2 * 1024 * 1024) {
            if (move_uploaded_file($tmpName, $uploadFile)) {
                $imagePaths[] = $uploadFile;
            } else {
                $errors[] = 'Error uploading file ' . $imageName;
            }
        } else {
            $errors[] = 'Invalid file type or file size too large for ' . $imageName;
        }
    }

    if (empty($errors)) {
        $db = new Database();
        $conn = $db->getConnection();

        // Insert ad details into the database
        $sql = "INSERT INTO featured_ads (title, description, location, price, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $adTitle, $adDescription, $adLocation, $adPrice, $_SESSION['user_id']);

        if ($stmt->execute()) {
            $ad_id = $stmt->insert_id;

            // Insert reference images
            foreach ($imagePaths as $path) {
                $sql = "INSERT INTO ad_images (ad_id, image_path) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("is", $ad_id, $path);
                $stmt->execute();
            }

            $message = 'Ad submitted successfully!';
        } else {
            $errors[] = 'Error submitting ad.';
        }

        $conn->close();
    }
}
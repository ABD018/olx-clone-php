<?php
require_once 'Models/UserModel.php';
require_once 'Models/AdModel.php';

class AdminController {
    public function __construct() {
        // Check if the user is logged in and is an admin
        session_start();
        if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
            header('Location: login.php');
            exit();
        }
    }

    public function index() {
        // Fetch all users and ads
        $users = UserModel::getAllUsers();
        $ads = AdModel::getAllAds();
        
        // Load the admin dashboard view
        require 'Views/admin_dashboard.php';
    }

    public function viewUser($userId) {
        $user = UserModel::getUserById($userId);
        $ads = AdModel::getAdsByUserId($userId);
        
        // Load the user details view
        require 'Views/user_details.php';
    }

    public function viewAd($adId) {
        $ad = AdModel::getAdById($adId);
        $user = UserModel::getUserById($ad['user_id']);
        
        // Load the ad details view
        require 'Views/ad_details.php';
    }
}
?>

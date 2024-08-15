<?php
session_start();

require_once 'models/AdminModel.php';

class AdminController {
    private $model;

    public function __construct() {
        $this->model = new AdminModel();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'dashboard';

        switch ($action) {
            case 'profile':
                $this->showProfile();
                break;
            case 'messages':
                $this->showMessages();
                break;
            case 'allusers':
                $this->showUsers();
                break;
            case 'allads':
                $this->showAds();
                break;
            case 'events':
                $this->AddEvents();
                break;
            case 'send_message':
                $this->sendMessage();
                break;
            case 'inbox':
                $this->inbox();
                break;
            default:
                $this->showDashboard();
                break;
        }
    }

    private function showProfile() {
        $user = $this->model->getUserData();
        include 'profile.php';
    }
    private function showUsers() {
        $messages = $this->model->getUsers();
        include 'all_users.php';
    }

    private function showAds() {
        $messages = $this->model->getAds();
        include 'all_ads.php';
    }

    private function AddEvents() {
        // Assuming POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $event_date = $_POST['event_date'] ?? '';
    
            if ($title && $event_date) {
                $this->model->addEvent($title, $event_date);
                $messages = 'Event added successfully.';
            } else {
                $messages = 'Please provide both title and date.';
            }
        }
    
        include 'add_event.php';
    }


        private function showMessages() {
            $userId = $_SESSION['user_id']; // Ensure user_id is stored in session
            $messages = $this->model->getUserMessages($userId);
            include 'messages.php';
        }

    private function sendMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sender_id = $_SESSION['user_id']; // Adjust as necessary
            $receiver_id = $_POST['receiver_id'];
            $message = $_POST['message'];

            if ($receiver_id && $message) {
                $this->model->sendMessage($sender_id, $receiver_id, $message);
                $messages = 'Message sent successfully.';
            } else {
                $messages = 'Please provide a receiver and a message.';
            }
        }

        $users = $this->model->getNamesOfUsers();
        include 'send_message.php'; // Form to send messages
    }
    private function inbox() {
        $adminId = $_SESSION['user_id']; // Ensure this is the admin's ID
        $messages = $this->model->getAdminInbox($adminId);
        include 'inbox.php';
    }
    

    private function showDashboard() {
        include 'admin_dashboard.php';
    }
}
?>

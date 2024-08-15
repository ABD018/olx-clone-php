<?php
require_once '/OLX_MODEL/clasifico/Models/database.php'; // Adjust the path according to your folder structure

class AdminModel {
    private $db;

    public function __construct() {
        // Create a new instance of the Database class
        $database = new Database();
        // Get the connection from the Database class
        $this->db = $database->getConnection();
    }

        // Add this method to access the $db property
        public function getConnection() {
            return $this->db;
        }
    public function getUserData() {
        $query = "SELECT * FROM users WHERE role = 'admin'";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsers() {
        $query = "SELECT name, email, profile_photo, address, phone_number FROM users WHERE role = 'user'";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNamesOfUsers() {
        // Replace this with actual database logic
        $query = "SELECT id, name, email FROM users";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);;
    }


    public function getAds() {
        $query = "
            SELECT 
                fa.id, fa.image, fa.category, fa.title, fa.price, fa.description, u.name AS author_name
            FROM 
                featured_ads fa
            JOIN 
                users u ON fa.user_id = u.id
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllAds() {
        $query = "SELECT * FROM ads";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDashboardStats() {
        $stats = [];

        // Total Users
        $query = "SELECT COUNT(*) as count FROM users WHERE role = 'user'";
        $result = $this->db->query($query);
        $stats['totalUsers'] = $result->fetch_assoc()['count'];

        // Total Ads
        $query = "SELECT COUNT(*) as count FROM featured_ads";
        $result = $this->db->query($query);
        $stats['totalAds'] = $result->fetch_assoc()['count'];



        // Total Revenue
        $query = "SELECT SUM(price) as revenue FROM featured_ads";
        $result = $this->db->query($query);
        $stats['totalRevenue'] = $result->fetch_assoc()['revenue'];

        // User Growth
        $query = "SELECT DATE(created_at) as date, COUNT(*) as count FROM users GROUP BY DATE(created_at)";
        $result = $this->db->query($query);
        $stats['userGrowth'] = $result->fetch_all(MYSQLI_ASSOC);

        // // Ads Posted Over Time
        // $query = "SELECT DATE(created_at) as date, COUNT(*) as count FROM featured_ads GROUP BY DATE(created_at)";
        // $result = $this->db->query($query);
        // $stats['adsPosted'] = $result->fetch_all(MYSQLI_ASSOC);

        // Category Distribution
        $query = "SELECT category, COUNT(*) as count FROM featured_ads GROUP BY category";
        $result = $this->db->query($query);
        $stats['categoryDistribution'] = $result->fetch_all(MYSQLI_ASSOC);

        // Top Ads by Rating
        $query = "SELECT title, rating FROM featured_ads ORDER BY rating DESC LIMIT 10";
        $result = $this->db->query($query);
        $stats['topAds'] = $result->fetch_all(MYSQLI_ASSOC);

        return $stats;
    }

    public function getNews() {
        $query = "SELECT title, description FROM news ORDER BY date_published DESC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getCategories() {
        $query = "SELECT category, COUNT(*) as count FROM featured_ads GROUP BY category";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function addEvent($title, $event_date) {
        // Prepare the SQL statement
        $query = "INSERT INTO events (title, event_date) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
    

    
        // Bind the parameters
        $stmt->bind_param('ss', $title, $event_date);
    
        // Execute the statement
        if (!$stmt->execute()) {
            die('Execute failed: ' . $stmt->error);
        }
    
        // Close the statement
        $stmt->close();
    }
    

    public function getEvents() {
        $query = "SELECT title AS title, event_date AS start FROM events";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);;
    }

    public function sendMessage($senderId, $receiverId, $message) {
        $query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iis', $senderId, $receiverId, $message);
        if (!$stmt->execute()) {
            die('Execute failed: ' . $stmt->error);
        }
        $stmt->close();
    }

    public function getUserMessages($userId) {
        $query = "
            SELECT messages.message, users.name AS receiver_name 
            FROM messages 
            JOIN users ON messages.receiver_id = users.id 
            WHERE messages.sender_id = ?
        ";

        $stmt = $this->db->prepare($query);

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }

        $stmt->bind_param('i', $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        // Fetch all messages
        $messages = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $messages;
    }

    public function getUserById($user_id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAdminInbox($adminId) {
        $sql = "SELECT m.*, u.name AS sender_name
                FROM messages m
                JOIN users u ON m.sender_id = u.id
                WHERE m.receiver_id = ?
                ORDER BY m.timestamp DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $adminId);
        $stmt->execute();
        $result = $stmt->get_result();
        $messages = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $messages;
    }
}
?>
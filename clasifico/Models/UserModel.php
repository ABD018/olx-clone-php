<?php
require_once 'database.php';
class UserModel {
    public static function getAllUsers() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM users');
        return $stmt->fetchAll();
    }

    public static function getUserById($userId) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM users WHERE id = '$userId'";
        $result = $conn->query($sql);

        return $result->fetch_assoc();
    }
}
?>

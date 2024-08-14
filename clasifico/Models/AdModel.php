<?php
class AdModel {
    public static function getAllAds() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM ads');
        return $stmt->fetchAll();
    }

    public static function getAdsByUserId($userId) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM ads WHERE user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public static function getAdById($adId) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM ads WHERE id = ?');
        $stmt->execute([$adId]);
        return $stmt->fetch();
    }
}
?>

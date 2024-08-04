<?php
require_once 'database.php';

function getCategories() {
    $db = new Database();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    $conn->close();
    return $categories;
}

function getFeaturedAds() {
    $db = new Database();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM featured_ads ORDER BY RAND()";
    $result = $conn->query($sql);

    $ads = [];
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }

    $conn->close();
    return $ads;
}

function getNews() {
    $db = new Database();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM news ORDER BY RAND()";
    $result = $conn->query($sql);

    $newsItems = [];
    while ($row = $result->fetch_assoc()) {
        $newsItems[] = $row;
    }

    $conn->close();
    return $newsItems;
}

function getPlaces() {
    $db = new Database();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM places ORDER BY RAND()";
    $result = $conn->query($sql);

    $places = [];
    while ($row = $result->fetch_assoc()) {
        $places[] = $row;
    }

    $conn->close();
    return $places;
}

function signup($data) {
    $db = new Database();
    $conn = $db->getConnection();

    if ($conn === false) {
        return ['error' => 'Could not connect to the database: ' . mysqli_connect_error()];
    }

    $name = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);
    $password = password_hash($conn->real_escape_string($data['password']), PASSWORD_BCRYPT);

    // Check if email already exists
    $checkEmailSql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailSql);

    if ($result->num_rows > 0) {
        $conn->close();
        return ['error' => 'Email already exists, please sign in'];
    }

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return ['success' => true];
    } else {
        $error = $conn->error;
        $conn->close();
        return ['error' => 'Error: ' . $error];
    }
}


function login($data) {
    $db = new Database();
    $conn = $db->getConnection();

    if ($conn === false) {
        return ['error' => 'Could not connect to the database: ' . mysqli_connect_error()];
    }

    $email = $conn->real_escape_string($data['email']);
    $password = $conn->real_escape_string($data['password']);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $conn->close();
            return ['success' => true];
        } else {
            $conn->close();
            return ['error' => 'Invalid password'];
        }
    } else {
        $conn->close();
        return ['error' => 'No user found with that email'];
    }
}

function getFeaturedAdById($id) {
    $db = new Database();
    $conn = $db->getConnection();

    $id = $conn->real_escape_string($id);

    $sql = "SELECT * FROM featured_ads WHERE id = $id";
    $result = $conn->query($sql);

    $ad = $result->fetch_assoc();
    
    $conn->close();
    return $ad;
}

function getUserById($userId) {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $user;
}

function updateUserProfile($userId, $name, $email, $password) {
    $db = new Database();
    $conn = $db->getConnection();

    // Password hashing
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $hashedPassword, $userId);
    
    $success = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $success;
}

?>

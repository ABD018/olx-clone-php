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

    $sql = "SELECT * FROM featured_ads ORDER BY RAND() LIMIT 6";
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

function signup($name, $email, $password, $role) {
    $db = new Database();
    $conn = $db->getConnection();

    if ($conn === false) {
        return ['error' => 'Could not connect to the database: ' . mysqli_connect_error()];
    }

    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $password = password_hash($conn->real_escape_string($password), PASSWORD_BCRYPT);
    $role = $conn->real_escape_string($role); // Sanitize the role input

    // Check if email already exists
    $checkEmailSql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailSql);

    if ($result->num_rows > 0) {
        $conn->close();
        return ['error' => 'Email already exists, please sign in'];
    }

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
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
            // Start the session if not already started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['role'] === 'admin';
            $_SESSION['user_name'] = $user['name']; // Store user name if needed
            
            $conn->close();
            return ['success' => true, 'is_admin' => $_SESSION['is_admin']];
        } else {
            $conn->close();
            return ['error' => 'Invalid password'];
        }
    } else {
        $conn->close();
        return ['error' => 'No user found with that email'];
    }
}

function modifyPassword($data) {
    $db = new Database();
    $conn = $db->getConnection();

    if ($conn === false) {
        return ['error' => 'Could not connect to the database: ' . mysqli_connect_error()];
    }

    if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];
    }
    else {
        $userID = $_SESSION['otp_user_id'];
    }  
    $password = $conn->real_escape_string($data['password']);
    $encrypted_password = password_hash($conn->real_escape_string($password), PASSWORD_BCRYPT);

    $sql = "SELECT * FROM users WHERE id = '$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare(
            "UPDATE users 
            SET password = ? WHERE id = ?"
        );
        $stmt->bind_param("si", $encrypted_password, $userID);
        $result = $stmt->execute();

        if ($result === false) {
            error_log('Update password failed: ' . $stmt->error);
        }

        $stmt->close();
        $conn->close();
        return ['success' => true];
    } else {
        $conn->close();
        return ['error' => 'No user found with that email'];
    }
}

function updateAd($ad_id, $title, $description, $price, $location) {
    $db = new Database();
    $conn = $db->getConnection();

    try {
        $stmt = $conn->prepare(
            "UPDATE featured_ads 
            SET title = ?, description = ?, price = ?, location = ? 
            WHERE id = ?"
        );

        if ($stmt === false) {
            error_log('Prepare failed: ' . $conn->error);
            return false;
        }

        $stmt->bind_param("ssdsi", $title, $description, $price, $location, $ad_id);

        $result = $stmt->execute();

        if ($result === false) {
            error_log('Execute failed: ' . $stmt->error);
        }

        $stmt->close();
        return $result;

    } catch (Exception $e) {
        error_log('Exception during updateAd execution: ' . $e->getMessage());
        return false;
    }
}


function deleteAd($ad_id, $user_id) {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("DELETE FROM featured_ads WHERE id = ? AND user_id = ?");

    
    if ($stmt === false) {
        error_log('Prepare failed: ' . $conn->error);
        return false;
    }

    $stmt->bind_param("ii", $ad_id, $user_id);
    $result = $stmt->execute();
    if ($result === false) {
        error_log('Execute failed: ' . $stmt->error);
    }

    $stmt->close();
    return $result;
}


function getFeaturedAdByUserId($userId) {
    $db = new Database();
    $conn = $db->getConnection();

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM featured_ads WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $ads = [];
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }    
    $stmt->close();
    $conn->close();
    return $ads;
}

function getFeaturedAdById($Id) {
    $db = new Database();
    $conn = $db->getConnection();

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM featured_ads WHERE id = ?");
    $stmt->bind_param("i", $Id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $ad = $result->fetch_assoc();   
    $stmt->close();
    $conn->close();
    return $ad;
}



function getAdsByCategory($categoryId) {
    $db = new Database();
    $conn = $db->getConnection();

    $categoryId = $conn->real_escape_string($categoryId);

    $sql = "SELECT * FROM featured_ads WHERE category = '$categoryId' ORDER BY RAND() LIMIT 6";
    $result = $conn->query($sql);

    $ads = [];
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }

    // Check the result of the query
    error_log("Ads found: " . print_r($ads, true));

    $conn->close();
    return $ads;
}

function getAdsByItemTitle($itemTitle) {
    $db = new Database();
    $conn = $db->getConnection();

    $itemTitle = $conn->real_escape_string($itemTitle);

    $sql = "SELECT * FROM featured_ads WHERE title like '%$itemTitle%'";
    $result = $conn->query($sql);

    $ads = [];
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }

    // Check the result of the query
    error_log("Ads found: " . print_r($ads, true));

    $conn->close();
    return $ads;
}



function getUserById($userId) {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT id, name, email, profile_photo, address, phone_number FROM users WHERE id = ?");
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

function addFeaturedAd($user_id, $title, $description, $adImage, $iconClass, $category, $location, $price, $authorImage, $authorName, $authorRole, $rating, $ratingCount, $timeAgo, $referenceImages) {
    $db = new Database();
    $conn = $db->getConnection();

    $createdAt = date('Y-m-d H:i:s'); // Current timestamp

    // Convert reference images array to JSON string
    $referenceImagesJson = json_encode($referenceImages);

    $stmt = $conn->prepare("INSERT INTO featured_ads (user_id, title, description, image, icon_class, category, location, price, author_image, author_name, author_role, rating, rating_count, time_ago, reference_images) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    // Bind parameters, including the JSON string for reference_images
    $stmt->bind_param("issssssssssssss", $user_id, $title, $description, $adImage, $iconClass, $category, $location, $price, $authorImage, $authorName, $authorRole, $rating, $ratingCount, $timeAgo, $referenceImagesJson);
    
    $success = $stmt->execute();
    if (!$success) {
        echo json_encode(['success' => false, 'error' => 'Execute failed: ' . $stmt->error]);
        exit;
    }

    $stmt->close();
    $conn->close();

    return $success;
}


function getAdDetails($ad_id) {
    global $conn; // Assuming you have a database connection stored in $conn

    $sql = "SELECT title, description, image_urls FROM featured_ads WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $ad_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function submitAd($data) {
    // Assuming you have a database connection in $conn (update this according to your connection variable)
    global $conn;

    $title = $data['title'];
    $description = $data['description'];
    $category = $data['category'];
    $location = $data['location'];
    $price = $data['price'];
    $adImagePath = $data['adImagePath'];
    $authorImagePath = $data['authorImagePath'];
    $authorName = $data['authorName'];
    $authorRole = $data['authorRole'];
    $iconClass = $data['iconClass'];
    $rating = $data['rating'];
    $ratingCount = $data['ratingCount'];
    $timeAgo = $data['timeAgo'];

    // SQL query to insert the ad details into the database
    $sql = "INSERT INTO featured_ads (title, description, image, icon_class, category, location, price, author_image, author_name, author_role, rating, rating_count, time_ago)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the query
        $stmt->bind_param("ssssssdsssiii", $title, $description, $adImagePath, $iconClass, $category, $location, $price, $authorImagePath, $authorName, $authorRole, $rating, $ratingCount, $timeAgo);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function getAllFeaturedAds() {
    $db = new Database();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM featured_ads";
    $result = $conn->query($sql);

    if ($result === false) {
        $conn->close();
        return ['error' => 'Query failed: ' . $conn->error];
    }

    $ads = [];
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }

    $conn->close();
    return $ads;
}

function getAllAdmins() {
    $db = new Database();
    $conn = $db->getConnection();
    $sql = "SELECT id, name FROM users WHERE role = 'admin'";
    $result = $conn->query($sql);
    
    $admins = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $admins[] = $row;
        }
    }
    return $admins;
}

function sendMessage($senderId, $receiverId, $message) {
    $db = new Database();
    $conn = $db->getConnection();
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iis', $senderId, $receiverId, $message);
    if (!$stmt->execute()) {
        die('Execute failed: ' . $stmt->error);
    }
    $stmt->close();
}

function getMessages($userId) {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Check if the connection is successful
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "SELECT m.*, u1.name AS sender_name, u2.name AS receiver_name
              FROM messages m
              JOIN users u1 ON m.sender_id = u1.id
              JOIN users u2 ON m.receiver_id = u2.id
              WHERE m.sender_id = ? OR m.receiver_id = ?
              ORDER BY m.timestamp DESC";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param('ii', $userId, $userId);

    // Execute the statement
    $stmt->execute();

    // Fetch the results
    $result = $stmt->get_result();
    $messages = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();
    
    return $messages;
}

function getUserInbox($userId) {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Check if the connection is successful
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    $sql = "SELECT m.*, u.name AS sender_name
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            WHERE m.receiver_id = ? AND u.role = 'admin'
            ORDER BY m.timestamp DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $messages = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return $messages;
}



?>

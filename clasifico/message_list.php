<?php
session_start(); // Start the session

require_once './Models/func.php';

$userId = $_SESSION['user_id']; // Assuming user ID is stored in session
$messages = getMessages($userId); // Fetch messages using the function
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message List</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <h1>Messages</h1>
    <ul>
        <?php foreach ($messages as $message) : ?>
            <li>
                <strong>
                    <?php 
                    if ($message['sender_id'] == $userId) {
                        // If the user is the sender, show the receiver's name
                        echo "To: " . htmlspecialchars($message['receiver_name']);
                    } else {
                        // If the user is the receiver, show the sender's name
                        echo "From: " . htmlspecialchars($message['sender_name']);
                    }
                    ?>:
                </strong>
                <p><?php echo htmlspecialchars($message['message']); ?></p>
                <small><?php echo htmlspecialchars($message['timestamp']); ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

<?php
require_once 'Models/func.php';

session_start(); // Start the session to access session variables

$userId = $_SESSION['user_id']; // Ensure this is the user's ID

// Create an instance of the model or access the function directly if it's a standalone function
$messages = getUserInbox($userId); // Call the function directly from func.php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Inbox</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <h1>Inbox</h1>
    <ul>
        <?php if (empty($messages)) : ?>
            <li>No messages from admins.</li>
        <?php else : ?>
            <?php foreach ($messages as $message) : ?>
                <li>
                    <strong>From Admin: <?php echo htmlspecialchars($message['sender_name']); ?>:</strong>
                    <p><?php echo htmlspecialchars($message['message']); ?></p>
                    <small><?php echo htmlspecialchars($message['timestamp']); ?></small>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>
</html>

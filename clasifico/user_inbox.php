<?php
require_once 'Models/func.php';

$userId = $_SESSION['user_id']; // Ensure this is the user's ID

// Create an instance of the model or access the function directly if it's a standalone function
$messages = getUserInbox($userId); // Call the function directly from func.php

?>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>From Admin</th>
            <th>Message</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($message['sender_name']); ?></strong></td>
                    <td><p><?php echo htmlspecialchars($message['message']); ?></p></td>
                    <td><small><?php echo htmlspecialchars($message['timestamp']); ?></small></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No messages from admins.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


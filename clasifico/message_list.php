<?php
require_once './Models/func.php';

$userId = $_SESSION['user_id']; // Assuming user ID is stored in session
$messages = getMessages($userId); // Fetch messages using the function
?>

<h1>Messages</h1>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Message</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($message['sender_name']); ?></strong></td>
                    <td><strong><?php echo htmlspecialchars($message['receiver_name']); ?></strong></td>
                    <td><p><?php echo htmlspecialchars($message['message']); ?></p></td>
                    <td><small><?php echo htmlspecialchars($message['timestamp']); ?></small></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No messages found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
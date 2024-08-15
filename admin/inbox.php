<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Inbox</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <h1>Inbox</h1>
    <ul>
        <?php if (empty($messages)) : ?>
            <li>No messages in your inbox.</li>
        <?php else : ?>
            <?php foreach ($messages as $message) : ?>
                <li>
                    <strong>From: <?php echo htmlspecialchars($message['sender_name']); ?>:</strong>
                    <p><?php echo htmlspecialchars($message['message']); ?></p>
                    <small><?php echo htmlspecialchars($message['timestamp']); ?></small>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
</head>
<body>
    <h1>Messages</h1>
    <ul>
        <?php if (!empty($messages)) : ?>
            <?php foreach ($messages as $message) : ?>
                <li>
                    <strong>To: <?php echo htmlspecialchars($message['receiver_name']); ?></strong><br>
                    <p><?php echo htmlspecialchars($message['message']); ?></p>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No messages found.</p>
        <?php endif; ?>
    </ul>
</body>
</html>

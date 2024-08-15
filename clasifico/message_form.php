<?php
session_start(); // Start the session

require_once './Models/func.php';

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    die('User is not logged in.');
}

$senderId = $_SESSION['user_id']; // Get the sender ID from session

// Fetch the list of admins from the database
$admins = getAllAdmins();

// Handle form submission
$messages = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $receiverId = $_POST['receiver_id'];
    $message = $_POST['message'];

    // Debugging: Output the values to ensure they are set correctly
    echo "<pre>Sender ID: $senderId\nReceiver ID: $receiverId\nMessage: $message</pre>";

    if ($senderId && $receiverId && $message) {
        // Debugging: Ensure the IDs are numeric
        if (!is_numeric($senderId) || !is_numeric($receiverId)) {
            die('Invalid sender or receiver ID.');
        }

        // Create a new Database connection object
        $db = new Database();
        $conn = $db->getConnection();

        // Ensure sender and receiver exist in users table
        $checkSender = $conn->prepare("SELECT COUNT(*) FROM users WHERE id = ?");
        $checkSender->bind_param('i', $senderId);
        $checkSender->execute();
        $checkSender->bind_result($senderExists);
        $checkSender->fetch();
        $checkSender->close();

        $checkReceiver = $conn->prepare("SELECT COUNT(*) FROM users WHERE id = ?");
        $checkReceiver->bind_param('i', $receiverId);
        $checkReceiver->execute();
        $checkReceiver->bind_result($receiverExists);
        $checkReceiver->fetch();
        $checkReceiver->close();

        if ($senderExists == 0 || $receiverExists == 0) {
            die('Sender or receiver does not exist.');
        }

        // Proceed with message sending
        sendMessage($senderId, $receiverId, $message);
        $messages = 'Message sent successfully.';
    } else {
        $messages = 'Please fill out all fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <h1>Send Message</h1>
    <?php if (isset($messages)) echo "<p>$messages</p>"; ?>
    <form action="" method="POST">
        <input type="hidden" name="sender_id" value="<?php echo $senderId; ?>">

        <label for="receiver_id">Select Admin:</label>
        <select id="receiver_id" name="receiver_id" required>
            <?php foreach ($admins as $admin): ?>
                <option value="<?php echo $admin['id']; ?>"><?php echo htmlspecialchars($admin['name']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <button type="submit">Send</button>
    </form>
</body>
</html>

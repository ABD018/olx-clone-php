<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
</head>
<body>
    <h1>Send Message</h1>
    <?php if (isset($messages)) echo "<p>$messages</p>"; ?>
    <form action="index.php?action=send_message" method="POST">
    <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user_id']; ?>">

<label for="receiver_id">Select Receiver:</label>
<select id="receiver_id" name="receiver_id" required>
    <option value="">--Select User--</option>
    <?php foreach ($users as $user) : ?>
        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']); ?></option>
    <?php endforeach; ?>
</select>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        
        <button type="submit">Send Message</button>
    </form>
</body>
</html>

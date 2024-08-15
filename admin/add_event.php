<?php
include 'sidebar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <div id="page-content-wrapper">
        <nav class="navbar">
            <button class="btn"><a href="index.php?action=dashboard">Back to Dashboard</a></button>
        </nav>

        <div class="container-fluid">
            <h1>Add New Event</h1>
            <?php if (isset($message)) echo "<p>$message</p>"; ?>
            <form action="index.php?action=events" method="POST">
    <label for="title">Event Title:</label>
    <input type="text" id="title" name="title" required>
    
    <label for="date">Event Date:</label>
    <input type="date" id="event_date" name="event_date" required>
    
    <button type="submit">Add Event</button>
</form>

<?php if (isset($messages)) : ?>
    <p><?php echo htmlspecialchars($messages); ?></p>
<?php endif; ?>

        </div>
    </div>
</body>
</html>

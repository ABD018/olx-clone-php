<div class="content-section" id="add-events">
    <h1>Add New Event</h1>
    <?php
        if (isset($message))
            echo "<p>$message</p>";
    ?>
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

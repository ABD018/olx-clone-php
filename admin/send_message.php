<div class="content-section" id="send-messages">
    <h1>Send Message</h1>
    <?php
        if (isset($messages))
            echo "<p>$messages</p>";
    ?>
    <form method="POST">
        <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user_id']; ?>">

        <div class="form-group">
            <label for="receiver_id">Select Receiver:</label>
            <div class="select-container">
                <select id="receiver_id" name="receiver_id" required>
                    <option value="">--Select User--</option>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']) . ' (' . htmlspecialchars($user['email']) . ')'; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        
        <button type="submit">Send Message</button>
    </form>
</div>

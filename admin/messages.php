<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>

<div class="content-section" id="messages">
    <h1>Messages</h1>
    <table>
        <thead>
            <tr>
                <th>Reciever Name</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($messages)) : ?>
                <?php foreach ($messages as $message) : ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($message['receiver_name']); ?></strong>
                        </td>
                        <td>
                            <p><?php echo htmlspecialchars($message['message']); ?></p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">No messages found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

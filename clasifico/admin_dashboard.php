<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="?controller=admin&action=index">All Users</a></li>
            <li><a href="?controller=admin&action=index">All Ads</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Admin Dashboard</h1>
        <h2>All Users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><a href="?controller=admin&action=viewUser&userId=<?= $user['id'] ?>"><?= $user['id'] ?></a></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h2>All Ads</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>User</th>
            </tr>
            <?php foreach ($ads as $ad): ?>
            <tr>
                <td><a href="?controller=admin&action=viewAd&adId=<?= $ad['id'] ?>"><?= $ad['id'] ?></a></td>
                <td><?= $ad['title'] ?></td>
                <td><a href="?controller=admin&action=viewUser&userId=<?= $ad['user_id'] ?>"><?= $ad['user_id'] ?></a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>
    <h1>User Details</h1>
    <p>ID: <?= $user['id'] ?></p>
    <p>Name: <?= $user['name'] ?></p>
    <p>Email: <?= $user['email'] ?></p>

    <h2>User Ads</h2>
    <ul>
        <?php foreach ($ads as $ad): ?>
        <li><?= $ad['title'] ?> - <a href="?controller=admin&action=viewAd&adId=<?= $ad['id'] ?>">View Ad</a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

<?php
session_start();
require_once '../admin/models/AdminModel.php'; // Ensure the path is correct
include 'sidebar.php';
// Instantiate the AdminModel
$adminModel = new AdminModel();

// Fetch all ads
$ads = $adminModel->getAds();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Ads</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Update with your actual CSS path -->
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
        img.ad-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div id="page-content-wrapper">
        <nav class="navbar">
            <button class="btn"><a href="index.php">Home</a></button>
        </nav>

        <div class="container-fluid">
            <h3>All Ads</h3>
            <table>
                <thead>
                    <tr>
                        <th>Ad Image</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Author Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ads)): ?>
                        <?php foreach ($ads as $ad): ?>
                            <tr>
                                <td>
                                    <?php
                                    $adImagePath = '../clasifico/' . $ad['image'];
                                    if (!empty($ad['image']) && file_exists($adImagePath)): ?>
                                        <img src="<?php echo htmlspecialchars($adImagePath); ?>" class="ad-image" alt="Ad Image">
                                    <?php else: ?>
                                        <img src="../assets/images/default-ad.png" class="ad-image" alt="Default Ad Image"> <!-- Replace with your default image path -->
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($ad['category']); ?></td>
                                <td><?php echo htmlspecialchars($ad['title']); ?></td>
                                <td><?php echo htmlspecialchars($ad['price']); ?></td>
                                <td><?php echo htmlspecialchars(substr($ad['description'], 0, 100)); ?>...</td>
                                <td><?php echo htmlspecialchars($ad['author_name']); ?></td>
                                <td><a href="../clasifico/browse-ads-details.php?id=<?php echo htmlspecialchars($ad['id']); ?>">View Details</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No ads found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

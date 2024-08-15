
<?php
session_start();
include 'sidebar.php';
require_once '../admin/models/AdminModel.php'; // Ensure the path is correct
// Instantiate the AdminModel
$adminModel = new AdminModel();

// Fetch all users
$users = $adminModel->getUsers();
?>
<div class="main-content">
    <h1>All Users</h1>
    <table id="usersTable">
        <!-- Table content populated by Ajax -->
    </table>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
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
        img.profile-photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div id="page-content-wrapper">
        <nav class="navbar">
            <button class="btn"><a href="index.php">Home</a></button>
        </nav>

        <div class="container-fluid">
            <h3>All Users</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile Photo</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <?php
                                    $profilePhotoPath = '../clasifico/' . $user['profile_photo'];
                                    if (!empty($user['profile_photo']) && file_exists($profilePhotoPath)): ?>
                                        <img src="<?php echo htmlspecialchars($profilePhotoPath); ?>" class="profile-photo" alt="Profile Photo">
                                    <?php else: ?>
                                        <img src="../assets/images/default-profile.png" class="profile-photo" alt="Default Photo"> <!-- Replace with your default image path -->
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($user['address']); ?></td>
                                <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

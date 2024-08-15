<?php
require_once '../admin/models/AdminModel.php'; // Ensure the path is correct

// Instantiate the AdminModel
$adminModel = new AdminModel();

// Fetch the database connection from the model
$db = $adminModel->getConnection();

// Fetch admin data from DB
$adminId = $_SESSION['user_id']; // Ensure this session is set correctly
$query = "SELECT * FROM users WHERE id = ? AND role = 'admin'";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $adminId); // Bind the $adminId parameter as an integer
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

if (!$admin) {
    die("Admin not found");
}

// Handle Profile Update
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);

    // Update the admin's profile in the database
    $updateQuery = "UPDATE users SET name = ?, email = ?, address = ?, phone_number = ? WHERE id = ?";
    $stmt = $db->prepare($updateQuery);
    $stmt->bind_param('ssssi', $name, $email, $address, $phone, $adminId);
    $stmt->execute();

    $admin['name'] = $name;
    $admin['email'] = $email;
    $admin['address'] = $address;
    $admin['phone_number'] = $phone;

    $message = "Profile updated successfully!";
}

// Handle Profile Photo Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile-photo'])) {
    $targetDir = "./assets/images"; // Update this path as needed
    $targetFile = $targetDir . basename($_FILES["profile-photo"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Validate image file type
    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($_FILES["profile-photo"]["tmp_name"], $targetFile)) {
            // Update the photo in the database
            $updatePhotoQuery = "UPDATE users SET profile_photo = ? WHERE id = ?";
            $stmt = $db->prepare($updatePhotoQuery);
            $stmt->bind_param('si', $targetFile, $adminId);
            $stmt->execute();

            $_SESSION['profile_photo'] = $targetFile;
            $admin['profile_photo'] = $targetFile;
            $message = "Profile photo updated successfully!";
        } else {
            $errors[] = "There was an error uploading the file.";
        }
    } else {
        $errors[] = "Invalid file type. Please upload an image file.";
    }
}
?>

<div class="content-section" id="profile">
    <h3>Admin Profile</h3>

    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="profile-section">
        <div class="profile-details">
            <form method="POST" action="update_profile">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name"
                        value="<?php echo htmlspecialchars($admin['name']); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        value="<?php echo htmlspecialchars($admin['email']); ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address"
                        value="<?php echo htmlspecialchars($admin['address']); ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone_number" name="phone"
                        value="<?php echo htmlspecialchars($admin['phone_number']); ?>">
                </div>
                <button type="submit" name="update_profile" class="btn btn-primary">Update
                    Profile</button>
            </form>
        </div>

        <div class="profile-picture-box">
            <img src="<?php echo htmlspecialchars($admin['profile_photo'] ?? 'assets/images/default-profile.png'); ?>"
                alt="Profile Picture" id="profile-pic">
            <form method="POST" enctype="multipart/form-data" class="change-photo-form">
                <input type="file" id="profile-photo" name="profile-photo" class="form-control">
                <button type="submit" class="btn btn-secondary change-photo-btn">Change Photo</button>
            </form>
            <button class="btn btn-secondary change-password-btn">Change Password</button>
        </div>
    </div>
</div>
<?php
session_start();
require_once 'Models/func.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user details
$user_id = $_SESSION['user_id'];
$user = getUserById($user_id);

if (!$user) {
    header('Location: login.php');
    exit();
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $errors = [];

    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($errors)) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $user_id);

        if ($stmt->execute()) {
            $message = 'Profile updated successfully!';
        } else {
            $errors[] = 'Error updating profile.';
        }

        $conn->close();
    }
}

// Handle photo upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile-photo'])) {
    $photo = $_FILES['profile-photo'];
    $uploadDir = 'assets/images/profiles/';
    $uploadFile = $uploadDir . basename($photo['name']);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    if (in_array($photo['type'], $allowedTypes) && $photo['size'] <= 2 * 1024 * 1024) { // Limit size to 2MB
        if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
            $db = new Database();
            $conn = $db->getConnection();

            $sql = "UPDATE users SET profile_photo = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $uploadFile, $user_id);

            if ($stmt->execute()) {
                $photo_url = htmlspecialchars($uploadFile);
                $message = 'Profile photo updated successfully!';
                $user['profile_photo'] = $photo_url; // Update user data to reflect new photo
            } else {
                $errors[] = 'Error updating profile photo.';
            }

            $conn->close();
        } else {
            $errors[] = 'Error uploading file.';
        }
    } else {
        $errors[] = 'Invalid file type or file size too large.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/profile.js" defer></script>
    <style>
       body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        #wrapper {
            display: flex;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        #sidebar-wrapper {
            width: 250px;
            height: 100%;
            background: #343a40;
            color: white;
            position: fixed;
            transition: all 0.3s ease-in-out;
        }

        #page-content-wrapper {
            width: calc(100% - 250px);
            margin-left: 250px;
            overflow-y: auto;
            transition: all 0.3s ease-in-out;
        }

        .list-group-item {
            padding: 10px 15px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            display: block;
            background-color: #343a40; /* Same as sidebar background */
            border-bottom: 1px solid white;
        }

        .list-group-item:hover {
            background-color: #495057;
        }

        .list-group-item.active {
            background-color: #007bff; /* Blue background for active state */
            color: white;
            font-weight: bold;
        }

        .content-section {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .content-section.active {
            display: block;
            opacity: 1;
        }

        .navbar {
            background: #f8f9fa;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:focus {
            outline: none;
        }

        .container-fluid {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .alert {
            padding: 15px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .alert ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .profile-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
        }

        .profile-details {
            flex: 1;
            margin-right: 20px;
        }

        .profile-picture-box {
            text-align: center;
            width: 200px;
        }

        .profile-picture-box img {
            width: 150px;
            height: 150px;
            border-radius: 50%; /* Circular shape */
            object-fit: cover; /* Ensure image covers the circular area */
        }

        .change-photo-btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">Dashboard</div>
            <div class="list-group list-group-flush my-3">
                <a href="#profile" class="list-group-item active">Profile</a>
                <a href="#listings" class="list-group-item">My Listings</a>
                <a href="#messages" class="list-group-item">Messages</a>
                <a href="#settings" class="list-group-item">Settings</a>
                <a href="logout.php" class="list-group-item">Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar">
                <button class="btn" id="menu-toggle">Toggle Menu</button>
            </nav>

            <div class="container-fluid">
                <div class="content-section active" id="profile">
                    <h3>User Profile</h3>

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
                            <form method="POST">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                                </div>
                                <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>

                        <div class="profile-picture-box">
                            <img src="<?php echo htmlspecialchars($user['profile_photo'] ?: 'assets/images/default-profile.png'); ?>" alt="Profile Picture" id="profile-pic">
                            <form method="POST" enctype="multipart/form-data" class="change-photo-form">
                                <input type="file" id="profile-photo" name="profile-photo" class="form-control">
                                <button type="submit" class="btn btn-secondary change-photo-btn">Change Photo</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="content-section" id="listings">
                    <h3>My Listings</h3>
                    <div class="card-deck">
                        <!-- Listing cards -->
                        <div class="card border-0 shadow-sm">
                            <img src="assets/images/listing1.jpg" class="card-img-top" alt="Listing 1">
                            <div class="card-body">
                                <h5 class="card-title">Listing Title</h5>
                                <p class="card-text">Some description of the listing.</p>
                            </div>
                            <div class="card-footer border-0 bg-transparent">
                                <small class="text-muted">Posted 3 mins ago</small>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm">
                            <img src="assets/images/listing2.jpg" class="card-img-top" alt="Listing 2">
                            <div class="card-body">
                                <h5 class="card-title">Listing Title</h5>
                                <p class="card-text">Some description of the listing.</p>
                            </div>
                            <div class="card-footer border-0 bg-transparent">
                                <small class="text-muted">Posted 10 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-section" id="messages">
                    <h3>Messages</h3>
                    <div class="list-group">
                        <!-- Messages -->
                        <a href="#" class="list-group-item list-group-item-action">Message from User 1</a>
                        <a href="#" class="list-group-item list-group-item-action">Message from User 2</a>
                    </div>
                </div>

                <div class="content-section" id="settings">
                    <h3>Settings</h3>
                    <form>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter new password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm new password">
                        </div>
                        <button type="submit" class="btn">Save Changes</button>
                    </form>
                </div>

                <div class="content-section" id="logout">
                    <h3>Logout</h3>
                    <button class="btn btn-danger">Logout</button>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Custom JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var menuToggle = document.getElementById("menu-toggle");
            var wrapper = document.getElementById("wrapper");
            var listGroupItems = document.querySelectorAll(".list-group-item");

            menuToggle.addEventListener("click", function(e) {
                e.preventDefault();
                wrapper.classList.toggle("toggled");
            });

            listGroupItems.forEach(function(item) {
                item.addEventListener("click", function(event) {
                    event.preventDefault();
                    
                    listGroupItems.forEach(function(item) {
                        item.classList.remove("active");
                    });
                    this.classList.add("active");

                    var target = this.getAttribute("href");

                    var contentSections = document.querySelectorAll(".content-section");
                    contentSections.forEach(function(section) {
                        section.classList.remove("active");
                        section.style.opacity = "0";
                    });

                    setTimeout(function() {
                        contentSections.forEach(function(section) {
                            section.style.display = "none";
                        });
                        var targetSection = document.querySelector(target);
                        targetSection.style.display = "block";
                        targetSection.classList.add("active");
                    }, 300);

                    setTimeout(function() {
                        var activeSection = document.querySelector(".content-section.active");
                        activeSection.style.opacity = "1";
                    }, 400);
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("#sidebar-wrapper .list-group-item").forEach(function(item) {
                item.addEventListener("click", function() {
                    var target = this.getAttribute("href").substring(1);
                    document.querySelectorAll(".content-section").forEach(function(section) {
                        section.classList.remove("active");
                    });
                    document.getElementById(target).classList.add("active");
                });
            });

            // Toggle sidebar
            document.getElementById("menu-toggle").addEventListener("click", function() {
                document.getElementById("wrapper").classList.toggle("toggled");
            });
        });
    </script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/jquery.fancybox.js"></script>
    <script src="assets/js/appear.js"></script>
    <script src="assets/js/scrollbar.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/ads.js"></script>
    <script src="assets/js/testimonials.js"></script>
    <script src="assets/js/ads_featured.js"></script>
    <script src="assets/js/top_places.js"></script>
    <script src="assets/js/news.js"></script>
    <script src="assets/js/categories.js"></script>
    <script src="assets/js/profile.js"></script>


    <!-- main-js -->
    <script src="assets/js/script.js"></script>
</body>
</html>

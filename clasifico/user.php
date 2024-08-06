<?php include 'userprofile.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

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
            display: block;
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
        .dropdown-menu {
    display: none;
}

.dropdown-menu.show {
    display: block;
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
                <button class="btn"><a href="index.php">Home</a></button>
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
                                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                                </div>
                                <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>

                        <div class="profile-picture-box">
                            <img src="<?php echo htmlspecialchars($_SESSION['profile_photo'] ?? $user['profile_photo'] ?? 'assets/images/default-profile.png'); ?>" alt="Profile Picture" id="profile-pic">
                            <form method="POST" enctype="multipart/form-data" class="change-photo-form">
                                <input type="file" id="profile-photo" name="profile-photo" class="form-control">
                                <button type="submit" class="btn btn-secondary change-photo-btn">Change Photo</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="content-section" id="listings">
                    <h3>My Listings</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitAdModal">
        Submit New Ad
    </button>
    

    <!-- Modal HTML code -->
<div class="modal fade" id="submitAdModal" tabindex="-1" role="dialog" aria-labelledby="submitAdModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitAdModalLabel">Submit New Ad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="submitAdForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="adTitle">Title</label>
                        <input type="text" class="form-control" id="adTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="adDescription">Description</label>
                        <textarea class="form-control" id="adDescription" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="adImage">Choose Photo</label>
                        <input type="file" class="form-control" id="adImage" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="referenceImages">Reference Images (Min. 3, Max. 5)</label>
                        <input type="file" class="form-control" id="referenceImages" name="referenceImages[]" accept="image/*" multiple required>
                        <small class="form-text text-muted">Upload up to 5 photos. At least 3 are required.</small>
                    </div>
                    <div class="form-group">
                        <label for="authorImage">Author Image</label>
                        <input type="file" class="form-control" id="authorImage" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="authorName">Author Name</label>
                        <input type="text" class="form-control" id="authorName" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="authorRole">Author Role</label>
                        <input type="text" class="form-control" id="authorRole" value="For Sell" readonly>
                    </div>
                    <div class="form-group">
                        <label for="adCategory">Category</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="adCategoryButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select Category
                            </button>
                            <div class="dropdown-menu" aria-labelledby="adCategoryButton">
                                <a class="dropdown-item" href="#" data-value="Property">Property</a>
                                <a class="dropdown-item" href="#" data-value="Home Appliances">Home Appliances</a>
                                <a class="dropdown-item" href="#" data-value="Electronics">Electronics</a>
                                <a class="dropdown-item" href="#" data-value="Health & Beauty">Health & Beauty</a>
                                <a class="dropdown-item" href="#" data-value="Automotive">Automotive</a>
                                <a class="dropdown-item" href="#" data-value="Furnitures">Furnitures</a>
                                <a class="dropdown-item" href="#" data-value="Real Estate">Real Estate</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adLocation">Location</label>
                        <input type="text" class="form-control" id="adLocation" required>
                    </div>
                    <div class="form-group">
                        <label for="adPrice">Price</label>
                        <input type="number" class="form-control" id="adPrice" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
            </div>
        </div>
    </div>
</div>


                    <div class="card-deck" id="listings-cards">
                        
                </div>
                <!-- Modal for submitting new ads -->
    


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


        document.getElementById('submitAdForm').addEventListener('submit', function(event) {
    var referenceImages = document.getElementById('referenceImages').files;
    if (referenceImages.length < 3) {
        event.preventDefault();
        alert('You must upload at least 3 reference images.');
        return;
    }
    if (referenceImages.length > 5) {
        event.preventDefault();
        alert('You can upload a maximum of 5 reference images.');
        return;
    }
});



    </script>
    <script src="assets/js/popper.min.js"></script>
    <!-- <script src="assets/js/validation.js"></script> -->
    <!-- <script src="assets/js/appear.js"></script> -->
    <!-- <script src="assets/js/scrollbar.js"></script> -->
    <!-- <script src="assets/js/ads_featured.js"></script> -->
    <script src="assets/js/categories.js"></script>
    <script src="assets/js/profile.js"></script>
    <!-- <script src="assets/js/jquery.min.js"></script> -->
    <!-- <script src="assets/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <!-- <script src="assets/js/script.js"></script> -->
</body>
</html>


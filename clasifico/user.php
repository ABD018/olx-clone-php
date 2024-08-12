<?php include 'userprofile.php';
require_once './Models/func.php';

// Fetch all featured ads
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch featured ads for the specific user
    $ads = getFeaturedAdByUserId($user_id);
} else {
    // Handle the case where the user ID is not available in the session
    $ads = []; // Empty array, no ads to show
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Add this CSS to your stylesheet */
        #imagePreviewContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* Space between images */
        }

        .image-container {
            position: relative;
            display: inline-block;
            /* Allows images to sit side by side */
        }

        .image-container img {
            display: block;
            width: 100px;
            /* Adjust as needed */
            height: 100px;
            /* Adjust as needed */
            object-fit: cover;
        }

        .remove-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 2px 5px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 14px;
            /* Adjust size as needed */
        }

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
            background: linear-gradient(135deg, #6e7bff, #a3a0f6);
            /* Gradient background */
            color: white;
            position: fixed;
            transition: all 0.3s ease-in-out;
            padding-top: 20px;
        }

        #page-content-wrapper {
            width: calc(100% - 250px);
            margin-left: 250px;
            overflow-y: auto;
            transition: all 0.3s ease-in-out;
        }

        .list-group-item {
            padding: 15px 20px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            background-color: transparent;
            border: none;
        }

        .list-group-item i {
            margin-right: 10px;
        }

        .list-group-item:hover {
            background-color: #495057;
        }

        .list-group-item.active {
            background-color: #ffffff;
            /* White background for active state */
            color: #007bff;
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
            background: #ffffff;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Add shadow */
        }

        .navbar .btn {
            background-color: #007bff;
            color: white;
            border-radius: 20px;
            /* Rounded button */
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .navbar .btn:hover {
            background-color: #0056b3;
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
            border-radius: 5px;
            margin-bottom: 20px;
            position: relative;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .alert i {
            margin-right: 10px;
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
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            border-radius: 50%;
            /* Circular shape */
            object-fit: cover;
            /* Ensure image covers the circular area */
            border: 2px solid #007bff;
            /* Add border around profile image */
        }

        .change-photo-btn {
            margin-top: 10px;
        }

        .dropdown-menu {
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu.show {
            display: block;
        }

        /* Modal Container */
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            padding: 20px;
            background: #ffffff;
        }

        /* Modal Header */
        .modal-header {
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            color: #333;
            font-weight: bold;
        }

        .modal-header .close {
            font-size: 1.5rem;
            color: #007bff;
        }

        .modal-header .close:hover {
            color: #0056b3;
        }

        /* Modal Body */
        .modal-body {
            padding: 20px;
            font-size: 1rem;
        }

        .modal-body .form-group {
            margin-bottom: 20px;
        }

        .modal-body label {
            font-weight: bold;
            color: #333;
        }

        .modal-body input[type="file"] {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
        }

        .modal-body .image-preview {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .modal-body .image-preview img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 4px;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        /* Modal Footer */
        .modal-footer {
            border-top: 2px solid #f1f1f1;
            padding-top: 15px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6e7bff, #a3a0f6);
            border: none;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6ef7, #8a8bfc);
        }

        .btn-secondary {
            background: #f1f1f1;
            color: #333;
            border-radius: 20px;
            padding: 10px 20px;
            border: none;
            margin-left: 10px;
        }

        .btn-secondary:hover {
            background: #ddd;
        }

        .navbar .btn {
            background-color: #007bff;
            color: white;
            border-radius: 20px;
            /* Rounded button */
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .navbar .btn:hover {
            background-color: #0056b3;
        }

        /* Adjust the home button visibility and hover */
        .navbar .btn a {
            color: white;
            text-decoration: none;
        }

        .navbar .btn a:hover {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                Dashboard</div>
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
                                    <input type="text" id="name" name="name"
                                        value="<?php echo htmlspecialchars($user['name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="<?php echo htmlspecialchars($user['email']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address"
                                        value="<?php echo htmlspecialchars($user['address']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" id="phone_number" name="phone"
                                        value="<?php echo htmlspecialchars($user['phone_number']); ?>">
                                </div>
                                <button type="submit" name="update_profile" class="btn btn-primary">Update
                                    Profile</button>
                            </form>
                        </div>

                        <div class="profile-picture-box">
                            <img src="<?php echo htmlspecialchars($_SESSION['profile_photo'] ?? $user['profile_photo'] ?? 'assets/images/default-profile.png'); ?>"
                                alt="Profile Picture" id="profile-pic">
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

                    <!-- Display ads in a table -->
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Location</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ads)): ?>
                                <?php $serialNo = 1; ?>
                                <?php foreach ($ads as $ad): ?>
                                    <tr id="ad-<?php echo $ad['id']; ?>">
                                        <td><?php echo $serialNo++; ?></td>
                                        <td class="ad-title"><?php echo htmlspecialchars($ad['title']); ?></td>
                                        <td class="ad-description"><?php echo htmlspecialchars($ad['description']); ?></td>
                                        <td class="ad-price"><?php echo htmlspecialchars($ad['price']); ?></td>
                                        <td class="ad-location"><?php echo htmlspecialchars($ad['location']); ?></td>
                                        <td>
                                            <img src="<?php echo htmlspecialchars($ad['image']); ?>" alt="Ad Image"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        </td>

                                        <td>
                                            <button class="btn btn-primary editAdForm" data-ad-id="<?php echo $ad['id']; ?>"
                                                data-title="<?php echo htmlspecialchars($ad['title']); ?>"
                                                data-description="<?php echo htmlspecialchars($ad['description']); ?>"
                                                data-price="<?php echo htmlspecialchars($ad['price']); ?>"
                                                data-location="<?php echo htmlspecialchars($ad['location']); ?>">
                                                Edit
                                            </button>
                                            <button id="delete-ad-button" class="btn btn-danger delete-ad-button"
                                                data-ad-id="<?php echo $ad['id']; ?>">Delete</button>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No ads found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Ad Edit Modal -->
                <div class="modal fade" id="adFormModal" tabindex="-1" aria-labelledby="adFormModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="adFormModalLabel">Edit Ad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="adForm" method="POST">
                                    <input type="hidden" name="ad_id" id="ad_id">
                                    <input type="hidden" name="update_ad" id="update_ad">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                            required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="update_ad_btn">Update Ad</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Modal HTML code -->
                <!-- Submit New Ad Modal -->
                <div class="modal fade" id="submitAdModal" tabindex="-1" role="dialog"
                    aria-labelledby="submitAdModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
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
                                        <input type="text" class="form-control" id="adTitle"
                                            placeholder="Enter the title of your ad" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="adDescription">Description</label>
                                        <textarea class="form-control" id="adDescription"
                                            placeholder="Describe your ad in detail" rows="4" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="adImage">Cover Photo</label>
                                        <input type="file" class="form-control-file" id="adImage" accept="image/*"
                                            required>
                                    </div>
                                    <!-- Reference Images Input -->

                                    <div class="form-group">
                                        <label for="reference_images">Reference Images (min 3, max 5)</label>
                                        <input type="file" name="reference_images[]" id="reference_images" multiple>
                                        <div class="image-preview" id="imagePreviewContainer"></div>

                                        <small class="form-text text-muted">You can select up to 5 images.</small>
                                    </div>
                                    <input type="hidden" id="selectedFilesData" name="selectedFilesData" value="">

                                    <div class="form-group">
                                        <label for="authorImage">Author Image</label>
                                        <input type="file" class="form-control-file" id="authorImage" accept="image/*"
                                            value="<?php echo htmlspecialchars($user['author_image']); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="authorName">Author Name</label>
                                        <input type="text" class="form-control" id="authorName"
                                            value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="authorRole">Author Role</label>
                                        <input type="text" class="form-control" id="authorRole" value="For Sell"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="adCategory">Category</label>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle form-control" type="button"
                                                id="adCategoryButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Select Category
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="adCategoryButton">
                                                <a class="dropdown-item" href="#" data-value="Property">Property</a>
                                                <a class="dropdown-item" href="#" data-value="Home Appliances">Home
                                                    Appliances</a>
                                                <a class="dropdown-item" href="#"
                                                    data-value="Electronics">Electronics</a>
                                                <a class="dropdown-item" href="#" data-value="Health & Beauty">Health &
                                                    Beauty</a>
                                                <a class="dropdown-item" href="#" data-value="Automotive">Automotive</a>
                                                <a class="dropdown-item" href="#" data-value="Furnitures">Furnitures</a>
                                                <a class="dropdown-item" href="#" data-value="Real Estate">Real
                                                    Estate</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="adLocation">Location</label>
                                        <input type="text" class="form-control" id="adLocation"
                                            placeholder="Enter location" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="adPrice">Price</label>
                                        <input type="number" class="form-control" id="adPrice" placeholder="Enter price"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Ad</button>
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
                            <input type="password" class="form-control" id="confirm-password"
                                placeholder="Confirm new password">
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
        document.addEventListener("DOMContentLoaded", function () {
            var menuToggle = document.getElementById("menu-toggle");
            var wrapper = document.getElementById("wrapper");
            var listGroupItems = document.querySelectorAll(".list-group-item");

            menuToggle.addEventListener("click", function (e) {
                e.preventDefault();
                wrapper.classList.toggle("toggled");
            });

            listGroupItems.forEach(function (item) {
                item.addEventListener("click", function (event) {
                    event.preventDefault();

                    listGroupItems.forEach(function (item) {
                        item.classList.remove("active");
                    });
                    this.classList.add("active");

                    var target = this.getAttribute("href");

                    var contentSections = document.querySelectorAll(".content-section");
                    contentSections.forEach(function (section) {
                        section.classList.remove("active");
                        section.style.opacity = "0";
                    });

                    setTimeout(function () {
                        contentSections.forEach(function (section) {
                            section.style.display = "none";
                        });
                        var targetSection = document.querySelector(target);
                        targetSection.style.display = "block";
                        targetSection.classList.add("active");
                    }, 300);

                    setTimeout(function () {
                        var activeSection = document.querySelector(".content-section.active");
                        activeSection.style.opacity = "1";
                    }, 400);
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("#sidebar-wrapper .list-group-item").forEach(function (item) {
                item.addEventListener("click", function () {
                    var target = this.getAttribute("href").substring(1);
                    document.querySelectorAll(".content-section").forEach(function (section) {
                        section.classList.remove("active");
                    });
                    document.getElementById(target).classList.add("active");
                });
            });

            // Toggle sidebar
            document.getElementById("menu-toggle").addEventListener("click", function () {
                document.getElementById("wrapper").classList.toggle("toggled");
            });
        });
        $(document).ready(function () {
            // Handle ad edit form submission
            document.querySelectorAll('.editAdForm').forEach(button => {

                button.addEventListener('click', function () {
                    const adId = this.getAttribute('data-ad-id');
                    const title = this.getAttribute('data-title');
                    const description = this.getAttribute('data-description');
                    const price = this.getAttribute('data-price');
                    const location = this.getAttribute('data-location');

                    // Populate the form with the ad's current data
                    document.querySelector('#adForm #ad_id').value = adId;
                    document.querySelector('#adForm #title').value = title;
                    document.querySelector('#adForm #description').value = description;
                    document.querySelector('#adForm #price').value = price;
                    document.querySelector('#adForm #location').value = location;

                    // Open the form (assuming it's a modal)
                    $('#adFormModal').modal('show');
                });
            });

            document.getElementById('adForm').addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                const formElement = this;
                if (!formElement) {
                    console.error("Form element not found.");
                    return;
                }

                const formData = new FormData(formElement);
                
                // Debug FormData
                for (const [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                fetch('edit_ad.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())  // Change to text to handle non-JSON responses
                .then(text => {
                    try {
                        const data = JSON.parse(text);  // Attempt to parse JSON
                        if (data.status === 'success') {
                            // Update the UI with the new details
                            const adId = formData.get('ad_id');
                            document.querySelector('#title').value = formData.get('title');
                            document.querySelector('#description').value = formData.get('description');
                            document.querySelector('#price').value = formData.get('price');
                            document.querySelector('#location').value = formData.get('location');

                            // update button details as well
                            const editBtn = jQuery('button[data-ad-id="' + adId + '"]').get(0);
                            editBtn.setAttribute('data-title', formData.get('title'));
                            editBtn.setAttribute('data-description', formData.get('description'));
                            editBtn.setAttribute('data-price', formData.get('price'));
                            editBtn.setAttribute('data-location', formData.get('location'));

                            $('#adFormModal').modal('hide');
                        } else {
                            alert('Failed to update ad.');
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        console.error('Response text:', text);
                    }
                })
                .catch(error => console.error('Error:', error));
            });




            // Handle ad deletion
            $('.delete-ad-button').on('click', function () {
                if (confirm('Are you sure you want to delete this ad?')) {
                    let adId = $(this).data('ad-id');

                    const formData = new URLSearchParams();
                    formData.append('ad_id', adId);

                    fetch('delete_ad.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            document.getElementById('ad-' + adId).remove();
                            alert(data.message);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
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
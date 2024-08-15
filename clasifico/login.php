<?php
require_once 'Models/func.php';
session_start();

// Check if the request is from AJAX
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Validate credentials (Hash passwords in practice)
//     $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
//     $stmt->execute([$email, $password]);
//     $user = $stmt->fetch();

//     if ($user) {
//         $_SESSION['user_id'] = $user['id']; // Set session variable
//         $_SESSION['is_admin'] = $user['role'] === 'admin'; // Check if the user is an admin
//         echo json_encode(['success' => true, 'is_admin' => $_SESSION['is_admin']]);
//     } else {
//         echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
//     }
//     exit(); // Ensure no further code is executed
// }
// 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];

    $result = login($data);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit(); // Ensure no further code is executed
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>olx - Login</title>

    <!-- Fav Icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="assets/css/font-awesome-all.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <link href="assets/css/owl.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/nice-select.css" rel="stylesheet">
    <link href="assets/css/color.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="assets/js/login.js" defer></script>
    <style>
       .form-error {
            color: red;
            font-size: 1em;
            text-align: center;
            margin-bottom: 10px;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="boxed_wrapper">
        <!-- preloader -->
        <div class="preloader"></div>

        <!-- main header -->
        <?php include 'header.php'; ?>

        <!-- Page Title -->
        <section class="page-title style-two" style="background-image: url(assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="content-box centred mr-0">
                    <div class="title">
                        <h1>Login</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Home</a></li>
                        <li>Login</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- login-section -->
        <section class="login-section bg-color-2">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="inner-box">
                        <h2>Login</h2>
                        <div class="other-content centred">
                            <ul class="social-links clearfix">
                                <li><a href="login.php"><i class="fab fa-facebook-f"></i>Login with Facebook</a></li>
                                <li><a href="login.php"><i class="fab fa-google-plus-g"></i>Login with Google Plus</a></li>
                            </ul>
                            <div class="text"><span>or</span></div>
                        </div>
                        <form action="login.php" method="post" class="login-form" id="login-form" novalidate>
                            <div id="form-error" class="form-error"></div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" required autocomplete="off" id="email" placeholder="Email">
                                <div id="email-error" class="error-message"></div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" required autocomplete="off" id="password" placeholder="Password">
                                <div id="password-error" class="error-message"></div>
                            </div>
                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn-one">Login</button>
                            </div>
                        </form>
                        <div class="othre-text centred">
                            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                        </div>
                        <div class="othre-text centred">
                            <p><a href="forgot_password.php">Forgot Password?</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- main-footer -->
        <?php include 'footer.php'; ?>

        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="far fa-long-arrow-up"></span>
        </button>
    </div>

    <script>
         document.getElementById('login-form').onsubmit = async function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const response = await fetch('login.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                if (result.is_admin) {
                    window.location.href = '/OLX_MODEL/admin/admin_dashboard.php'; // Redirect to admin dashboard
                } else {
                    window.location.href = '/OLX_MODEL/clasifico/user.php'; // Redirect to user dashboard
                }
            } else {
                document.getElementById('loginError').textContent = result.error;
            }
        };
    </script>

    <!-- jQuery plugins -->
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
    <script src="assets/js/product-filter.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>

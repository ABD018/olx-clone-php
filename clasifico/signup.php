<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>olx - Sign Up</title>

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
    <script src="assets/js/signup.js" defer></script>
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
                        <h1>Sign up</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Home</a></li>
                        <li>Sign up</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- signup-section -->
        <section class="login-section signup-section bg-color-2">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="inner-box">
                        <h2>Sign up</h2>
                        <!-- <div class="other-content centred">
                            <ul class="social-links clearfix">
                                <li><a href="login.php"><i class="fab fa-facebook-f"></i>Login with Facebook</a></li>
                                <li><a href="login.php"><i class="fab fa-google-plus-g"></i>Login with Google Plus</a></li>
                            </ul>
                            <div class="text"><span>or</span></div>
                        </div> -->
                        <!-- <div class="error-container" style="display: none; color: red;"></div> -->
                        <form action="signup.php" method="post" class="signup-form" id="signup-form" novalidate>
    <div id="form-error" class="form-error"></div>

    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" required autocomplete="off" placeholder="Name" id="name">
        <div id="name-error" class="error-message"></div>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required autocomplete="off" placeholder="Email" id="email">
        <div id="email-error" class="error-message"></div>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required autocomplete="off" placeholder="Password" id="password">
        <div id="password-error" class="error-message"></div>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm-password" required autocomplete="off" placeholder="Confirm password" id="confirm_password">
        <div id="confirm_password-error" class="error-message"></div>
    </div>
    <div class="form-group message-btn">
        <button type="submit" class="theme-btn-one">Sign up</button>
    </div>
</form>
                        <div class="othre-text centred">
                            <p>Already have an account? <a href="login.php">Sign in</a></p>
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

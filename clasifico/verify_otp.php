<?php
require_once 'Models/func.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize database connection
    $db = new Database();
    $conn = $db->getConnection();

    $otp = $_POST['otp'];
    $user_id = $_SESSION['otp_user_id'];

    // Check if the OTP is valid
    $stmt = $conn->prepare('SELECT * FROM otp_verification WHERE user_id = ? AND otp = ? AND expires_at > NOW()');
    $stmt->bind_param('is', $user_id, $otp);
    $stmt->execute();
    $otpRecord = $stmt->get_result()->fetch_assoc();

    if ($otpRecord) {
        // OTP is valid, redirect to reset password page
        header('Location: reset_password.php');
        exit();
    } else {
        $error_message = "Invalid or expired OTP.";
    }
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
                        <h1>Verify OTP</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Home</a></li>
                        <li>Verify OTP</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- login-section -->
        <section class="login-section bg-color-2">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="inner-box">
                        <h2>Verify OTP:</h2>
                        <form action="verify_otp.php" method="post" novalidate>
                            <div id="form-error" class="form-error">
                                <?php if (isset($error_message)): ?>
                                    <?php echo $error_message; ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="otp">Enter OTP:</label>
                                <input type="text" name="otp" id="otp" class="form-control" required>
                            </div>
                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn-one">Submit</button>
                            </div>
                        </form>
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

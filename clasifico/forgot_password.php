<?php
require_once 'Models/func.php';

session_start();

use PHPMailer\PHPMailer\PHPMailer;

require 'C:/xampp/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Initialize database connection
    $db = new Database();
    $conn = $db->getConnection();

    // Check if the email exists in the users table
    $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->bind_param('s', $email); // Bind parameters to prevent SQL injection
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // Use fetch_assoc() to get an associative array

    if ($user) {
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);
        date_default_timezone_set('Asia/Kolkata');
        $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP expires in 10 minutes

        // Insert OTP into otp_verification table
        $stmt = $conn->prepare('INSERT INTO otp_verification (user_id, otp, expires_at) VALUES (?, ?, ?)');
        if ($stmt) {
            $stmt->bind_param('iss', $user['id'], $otp, $expires_at);
            $stmt->execute();

            // Send the OTP to the user's email
            // mail($email, "Your OTP Code", "Your OTP code is $otp. It will expire in 10 minutes.");
            $phpmailer = new PHPMailer(true);
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io'; // SMTP server
            $phpmailer->SMTPAuth = true;                   // Enable SMTP authentication
            $phpmailer->Username = 'e50d7151118e58';       // SMTP username
            $phpmailer->Password = '9e3dfc14385396';       // SMTP password
            $phpmailer->Port = 2525;

             // Recipients
            $phpmailer->setFrom('noreply@olxclone.com', 'OLX Clone');
            $phpmailer->addAddress($email);                // Add a recipient

            // Content
            $phpmailer->isHTML(true);                      // Set email format to HTML
            $phpmailer->Subject = 'Your OTP Code';
            $phpmailer->Body    = "Your OTP code is <b>$otp</b>. It will expire in 10 minutes.";
            $phpmailer->AltBody = "Your OTP code is $otp. It will expire in 10 minutes."; // Plain text for non-HTML mail clients

            $phpmailer->send();

            // Redirect to verify OTP page
            $_SESSION['otp_user_id'] = $user['id'];
            header('Location: verify_otp.php');
            exit();
        } else {
            $error_message = "Failed to prepare OTP insertion query.";
        }
    } else {
        $error_message = "Email does not exist.";
    }

    $conn->close(); // Close the connection
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
                        <h1>Forgot Password</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Home</a></li>
                        <li>Forgot Password</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- login-section -->
        <section class="login-section bg-color-2">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="inner-box">
                        <h2>Forgot Password:</h2>
                        <form action="forgot_password.php" method="post" novalidate>
                            <div id="form-error" class="form-error">
                                <?php if (isset($error_message)): ?>
                                    <?php echo $error_message; ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Enter your email address:</label>
                                <input type="email" name="email" required autocomplete="off" id="email" placeholder="Email">
                                <div id="email-error" class="error-message"></div>
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

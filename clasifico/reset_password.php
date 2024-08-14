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
                        <h1>Reset Password</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Home</a></li>
                        <li>Reset Password</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- login-section -->
        <section class="login-section bg-color-2">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="inner-box">
                        <h2>Reset Password:</h2>
                        <form action="login.php" method="post" id="resetPasswordForm" novalidate>
                            <div id="form-error" class="form-error">
                                <?php if (isset($error_message)): ?>
                                    <?php echo $error_message; ?>
                                <?php endif; ?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('#resetPasswordForm');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(function(el) {
                el.textContent = '';
            });

            const password = document.getElementById('password').value.trim();
            const confirmPassword = document.getElementById('confirm_password').value.trim();

            let hasError = false;

            // Basic validation
            if (password === '') {
                document.getElementById('password-error').textContent = 'Password is required';
                hasError = true;
            } else if (!validatePassword(password)) {
                document.getElementById('password-error').textContent = 'Password must be 6-12 characters long, contain at least one uppercase letter, and can include only @ as a special character';
                hasError = true;
            }
            if (confirmPassword === '') {
                document.getElementById('confirm_password-error').textContent = 'Confirm password is required';
                hasError = true;
            } else if (password !== confirmPassword) {
                document.getElementById('confirm_password-error').textContent = 'Passwords do not match';
                hasError = true;
            }

            if (hasError) return;

            const formData = new FormData(this);

            fetch('controller/userController.php?action=resetPassword', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'login.php';
                } else {
                    document.getElementById('form-error').textContent = data.error || 'Reset pasword failed';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('form-error').textContent = 'Reset pasword failed';
            });
        });

        function validatePassword(password) {
            const re = /^(?=.*[A-Z])[A-Za-z0-9@]{6,12}$/;
            return re.test(password);
        }

        // Add input event listeners for styling and error message removal
        document.querySelectorAll('#resetPasswordForm input').forEach(function(input) {
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.style.borderColor = 'green';
                    document.getElementById(`${this.id}-error`).textContent = '';
                } else {
                    this.style.borderColor = 'red';
                }
            });
        });
    });

    </script>
</body>
</html>

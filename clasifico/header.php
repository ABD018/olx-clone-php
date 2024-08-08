<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']); // Assuming 'user_id' is set when the user is logged in
?>
<header class="main-header">
    <!-- header-lower -->
    <div class="header-lower">
        <div class="auto-container">
            <div class="outer-box">
                <div class="logo-box">
                    <figure class="logo"><a href="index.php"><img src="assets/images/logo.png" alt="olx_logo"></a></figure>
                </div>
                <div class="menu-area">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="index.php">Home</a></li>
                                <li><a href="category.php">Categories</a></li>  
                                <li><a href="browse-ads-1.php">Browse Ads</a>
                                </li> 
                                <li class="dropdown"><a href="#">Pages</a>
                                    <ul>
                                        <li><a href="about.php">About Us</a></li>
                                        <li><a href="faq.php">Faq'S</a></li>
                                        <li><a href="contact.php">Contact Us</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.php">Blog</a></li> 

                                <!-- Conditional Links -->
                                <?php if ($isLoggedIn): ?>
                                    <li><a href="user.php">Profile</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                <?php else: ?>
                                    <li><a href="login.php">Login</a></li> 
                                    <li><a href="signup.php">Signup</a></li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="btn-box">
                    <?php if($isLoggedIn): ?>
                    <a href="user.php#listings" class="theme-btn-one"><i class="icon-1"></i>Submit Ads</a>
                    <?php else : ?>
                        <a href="login.php" class="theme-btn-one"><i class="icon-1"></i>Submit Ads</a>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="outer-box">
                <div class="logo-box">
                    <figure class="logo"><a href="index.php"><img src="assets/images/logo.png" alt=""></a></figure>
                </div>
                <div class="menu-area">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="browse-ads-details.php" class="theme-btn-one"><i class="icon-1"></i>Submit Ads</a>
                </div>
            </div>
        </div>
    </div>
</header>

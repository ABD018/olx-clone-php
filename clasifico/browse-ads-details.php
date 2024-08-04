<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from azim.commonsupport.com/Clasifico/browse-ads-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jul 2024 12:26:38 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Clasifico - HTML 5 Template Preview</title>

<!-- Fav Icon -->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">

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

</head>


<!-- page wrapper -->
<body>
<?php
require_once 'Models/func.php';

// Get the ad ID from the URL
$adId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($adId > 0) {
    // Fetch the ad details based on the ID
    $ad = getFeaturedAdById($adId);

    if ($ad) {
        // Display the ad details
        // Use HTML structure to display the ad details
    } else {
        echo '<p>Ad not found.</p>';
    }
} else {
    echo '<p>No ad ID specified.</p>';
}
?>
<style>
                .page-title-2 {
                    background-image: url('<?php echo htmlspecialchars($ad['image']); ?>');
                    background-size: cover;
                    background-position: center;
                }
                .profile-image-box img {
                    border-radius: 50%;
                }
            </style>

    <div class="boxed_wrapper">


        <!-- preloader -->
        <div class="preloader"></div>
        <!-- preloader -->


        <!-- main header -->
        <?php include 'header.php' ?>
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><a href="index.php"><img src="assets/images/logo-2.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
                <div class="contact-info">
                    <h4>Contact Info</h4>
                    <ul>
                        <li>Chicago 12, Melborne City, USA</li>
                        <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                        <li><a href="mailto:info@example.com">info@example.com</a></li>
                    </ul>
                </div>
                <div class="social-links">
                    <ul class="clearfix">
                        <li><a href="index.php"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="index.php"><span class="fab fa-facebook-square"></span></a></li>
                        <li><a href="index.php"><span class="fab fa-pinterest-p"></span></a></li>
                        <li><a href="index.php"><span class="fab fa-instagram"></span></a></li>
                        <li><a href="index.php"><span class="fab fa-youtube"></span></a></li>
                    </ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->


        <!-- Page Title -->
        
        <section class="page-title-2">
                <div class="auto-container">
                    <div class="content-box">
                        <h1><?php echo htmlspecialchars($ad['title']); ?></h1>
                        <span class="category"><i class="fas fa-tags"></i><?php echo htmlspecialchars($ad['category']); ?></span>
                    </div>
                    <div class="info-box clearfix">
                        <div class="left-column pull-left clearfix">
                            <div class="image-box"><img src="<?php echo htmlspecialchars($ad['author_image']); ?>" alt=""></div>
                            <h4><?php echo htmlspecialchars($ad['author_name']); ?><i class="icon-18"></i></h4>
                            <ul class="rating clearfix">
                                <?php for ($i = 0; $i < $ad['rating']; $i++): ?>
                                    <li><i class="icon-17"></i></li>
                                <?php endfor; ?>
                                <li><a href="index.php">(<?php echo htmlspecialchars($ad['rating_count']); ?>)</a></li>
                            </ul>
                            <span class="sell">For sell</span>
                            <h5><span>Start From:</span>$<?php echo htmlspecialchars($ad['price']); ?></h5>
                        </div>
                        <div class="right-column pull-right clearfix">
                            <ul class="links-list clearfix">
                                <li class="share-option">
                                    <a href="browse-add-details.html" class="share-btn"><i class="fas fa-share-alt"></i></a>
                                    <ul>
                                        <li><a href="browse-add-details.html"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="browse-add-details.html"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="browse-add-details.html"><i class="fab fa-google-plus-g"></i></a></li>
                                        <li><a href="browse-add-details.html"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </li>
                                <li><a href="browse-add-details.php"><i class="icon-21"></i></a></li>
                                <li><a href="browse-add-details.php"><i class="icon-22"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        <!-- End Page Title -->


        <!-- browse-add-details -->
        <section class="browse-add-details bg-color-2">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="add-details-content">
                            <div class="content-one single-box">
                                <div class="text">
                                    <h3>Product Description</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed eiusm tempor incididunt labore dolore magna aliqua enim minim veniam quis nostrud exercitation laboris nisi ut aliquip ea commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur occaecat pariatur occaecat</p>
                                    <p>Excepteur sint occaecat cupidatat non proident s unt in culpa qui officia deserunt mollit anim  est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium totam rem aperiam.</p>
                                </div>
                            </div>
                            <div class="content-two single-box">
                                <div class="bxslider">
                                    <div class="slider-content">
                                        <div class="product-image">
                                            <figure class="image"><img src="assets/images/resource/add-single-1.jpg" alt=""></figure>
                                        </div>
                                        <div class="slider-pager">
                                            <ul class="thumb-box clearfix">
                                                <li>
                                                    <a class="active" data-slide-index="0" href="#"><figure><img src="assets/images/resource/single-thumb-1.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="1" href="#"><figure><img src="assets/images/resource/single-thumb-2.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="2" href="#"><figure><img src="assets/images/resource/single-thumb-3.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="3" href="#"><figure><img src="assets/images/resource/single-thumb-4.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="4" href="#"><figure><img src="assets/images/resource/single-thumb-5.jpg" alt=""></figure></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="slider-content">
                                        <div class="product-image">
                                            <figure class="image"><img src="assets/images/resource/add-single-2.jpg" alt=""></figure>
                                        </div>
                                        <div class="slider-pager">
                                            <ul class="thumb-box clearfix">
                                                <li>
                                                    <a class="active" data-slide-index="0" href="#"><figure><img src="assets/images/resource/single-thumb-1.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="1" href="#"><figure><img src="assets/images/resource/single-thumb-2.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="2" href="#"><figure><img src="assets/images/resource/single-thumb-3.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="3" href="#"><figure><img src="assets/images/resource/single-thumb-4.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="4" href="#"><figure><img src="assets/images/resource/single-thumb-5.jpg" alt=""></figure></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="slider-content">
                                        <div class="product-image">
                                            <figure class="image"><img src="assets/images/resource/add-single-3.jpg" alt=""></figure>
                                        </div>
                                        <div class="slider-pager">
                                            <ul class="thumb-box clearfix">
                                                <li>
                                                    <a class="active" data-slide-index="0" href="#"><figure><img src="assets/images/resource/single-thumb-1.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="1" href="#"><figure><img src="assets/images/resource/single-thumb-2.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="2" href="#"><figure><img src="assets/images/resource/single-thumb-3.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="3" href="#"><figure><img src="assets/images/resource/single-thumb-4.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="4" href="#"><figure><img src="assets/images/resource/single-thumb-5.jpg" alt=""></figure></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="slider-content">
                                        <div class="product-image">
                                            <figure class="image"><img src="assets/images/resource/add-single-4.jpg" alt=""></figure>
                                        </div>
                                        <div class="slider-pager">
                                            <ul class="thumb-box clearfix">
                                                <li>
                                                    <a class="active" data-slide-index="0" href="#"><figure><img src="assets/images/resource/single-thumb-1.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="1" href="#"><figure><img src="assets/images/resource/single-thumb-2.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="2" href="#"><figure><img src="assets/images/resource/single-thumb-3.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="3" href="#"><figure><img src="assets/images/resource/single-thumb-4.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="4" href="#"><figure><img src="assets/images/resource/single-thumb-5.jpg" alt=""></figure></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="slider-content">
                                        <div class="product-image">
                                            <figure class="image"><img src="assets/images/resource/add-single-5.jpg" alt=""></figure>
                                        </div>
                                        <div class="slider-pager">
                                            <ul class="thumb-box clearfix">
                                                <li>
                                                    <a class="active" data-slide-index="0" href="#"><figure><img src="assets/images/resource/single-thumb-1.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="1" href="#"><figure><img src="assets/images/resource/single-thumb-2.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="2" href="#"><figure><img src="assets/images/resource/single-thumb-3.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="3" href="#"><figure><img src="assets/images/resource/single-thumb-4.jpg" alt=""></figure></a>
                                                </li>
                                                <li>
                                                    <a data-slide-index="4" href="#"><figure><img src="assets/images/resource/single-thumb-5.jpg" alt=""></figure></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-three single-box">
                                <div class="text">
                                    <h3>Features:</h3>
                                    <ul class="list-item clearfix">
                                        <li>256GB PCI flash storage</li>
                                        <li>2.7 GHz dual-core Intel Core i5 processor</li>
                                        <li>Turbo Boost up to 3.1GHz</li>
                                        <li>Intel Iris Graphics 6100</li>
                                        <li>8GB memory (up from 4GB in 2013 model)</li>
                                        <li>1 Year international warranty</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-four single-box">
                                <div class="text">
                                    <h3>Location</h3>
                                </div>
                                <div class="contact-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55945.16225505631!2d-73.90847969206546!3d40.66490264739892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1601263396347!5m2!1sen!2sbd"></iframe>
                                </div>
                                <ul class="info-box clearfix">
                                    <li><span>Address:</span> Virginia drive temple hills</li>
                                    <li><span>Country:</span> United State</li>
                                    <li><span>State/county:</span> California</li>
                                    <li><span>Neighborhood:</span> Andersonville</li>
                                    <li><span>Zip/Postal Code:</span> 2403</li>
                                    <li><span>City:</span> Brooklyn</li>
                                </ul>
                            </div>
                            <div class="content-five single-box">
                                <div class="text">
                                    <h4>Leave a Review</h4>
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                </div>
                                <form action="https://azim.commonsupport.com/Clasifico/browse-add-details.html" method="post" class="review-form">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Your Name*</label>
                                                <input type="text" name="name" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Your Email*</label>
                                                <input type="email" name="email" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Review Title*</label>
                                                <input type="text" name="title" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Your Rating*</label>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-32"></i></li>
                                                    <li><i class="icon-32"></i></li>
                                                    <li><i class="icon-32"></i></li>
                                                    <li><i class="icon-32"></i></li>
                                                    <li><i class="icon-32"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Review Title*</label>
                                                <textarea name="message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn-one">Submit Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar category-sidebar">
                            <div class="sidebar-search sidebar-widget">
                                <div class="widget-title">
                                    <h3>Search</h3>
                                </div>
                                <div class="widget-content">
                                    <form action="https://azim.commonsupport.com/Clasifico/category-details.html" method="post" class="search-form">
                                        <div class="form-group">
                                            <input type="search" name="search-field" placeholder="Search Keyword..." required="">
                                            <button type="submit"><i class="icon-2"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <i class="icon-3"></i>
                                            <select class="wide">
                                               <option data-display="Select Location">Select Location</option>
                                               <option value="1">California</option>
                                               <option value="2">New York</option>
                                               <option value="3">Sun Francis</option>
                                               <option value="4">Shicago</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <i class="icon-4"></i>
                                            <select class="wide">
                                               <option data-display="Select Category">Select Category</option>
                                               <option value="1">Education</option>
                                               <option value="2">Restaurant</option>
                                               <option value="3">Real Estate</option>
                                               <option value="4">Home Appliances</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-category sidebar-widget">
                                <div class="widget-title">
                                    <h3>Category</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="category-list">
                                        <li><a href="category-details.html">All</a></li>
                                        <li><a href="category-details.html">Air Condition</a></li>
                                        <li class="dropdown">
                                            <a href="category-details.html" class="current">Ellectronics</a>
                                            <ul>
                                                <li><a href="category-details.html">Computers</a></li>
                                                <li><a href="category-details.html">Drones</a></li>
                                                <li><a href="category-details.html">Phones</a></li>
                                                <li><a href="category-details.html">Watches</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="category-details.html">Furniture</a></li>
                                        <li class="dropdown">
                                            <a href="category-details.html">Health & Beauty</a>
                                            <ul>
                                                <li><a href="category-details.html">Spa</a></li>
                                                <li><a href="category-details.html">Messages</a></li>
                                                <li><a href="category-details.html">Fitness</a></li>
                                                <li><a href="category-details.html">Injuries</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="category-details.html">Automotive</a></li>
                                        <li><a href="category-details.html">Real Estate</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="price-filter sidebar-widget">
                                <div class="widget-title">
                                    <h3>Pricing range</h3>
                                </div>
                                <div class="price-range">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                            <input type="text" name="min_price" placeholder="Min">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                            <input type="text" name="max_price" placeholder="Max">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <button type="submit" class="theme-btn-one">Apply price</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- browse-add-details end -->


        <!-- related-ads -->
        <section class="related-ads">
            <div class="auto-container">
                <div class="sec-title">
                    <span>Related Ads</span>
                    <h2>Related Ads</h2>
                </div>
                <div class="three-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/resource/feature-1.jpg" alt=""></figure>
                                <div class="shape"></div>
                                <div class="feature">Featured</div>
                                <div class="icon">
                                    <div class="icon-shape"></div>
                                    <i class="icon-16"></i>
                                </div>
                                <ul class="rating clearfix">
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><a href="index.php">(32)</a></li>
                                </ul>
                                <h5>$3,000.00</h5>
                            </div>
                            <div class="lower-content">
                                <div class="author-box">
                                    <div class="inner">
                                        <img src="assets/images/resource/author-1.png" alt="">
                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                        <span>For sell</span>
                                    </div>
                                </div>
                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                <h3>Villa on Grand Avenue </h3>
                            </div>
                        </div>
                    </div>
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/resource/feature-2.jpg" alt=""></figure>
                                <div class="shape"></div>
                                <div class="feature">Featured</div>
                                <div class="icon">
                                    <div class="icon-shape"></div>
                                    <i class="icon-16"></i>
                                </div>
                                <ul class="rating clearfix">
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><a href="index.php">(25)</a></li>
                                </ul>
                                <h5>$2,000.00</h5>
                            </div>
                            <div class="lower-content">
                                <div class="author-box">
                                    <div class="inner">
                                        <img src="assets/images/resource/author-2.png" alt="">
                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                        <span>For sell</span>
                                    </div>
                                </div>
                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                <h3>Villa on Grand Avenue </h3>
                            </div>
                        </div>
                    </div>
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/resource/feature-3.jpg" alt=""></figure>
                                <div class="shape"></div>
                                <div class="feature">Featured</div>
                                <div class="icon">
                                    <div class="icon-shape"></div>
                                    <i class="icon-16"></i>
                                </div>
                                <ul class="rating clearfix">
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><a href="index.php">(30)</a></li>
                                </ul>
                                <h5>$3,500.00</h5>
                            </div>
                            <div class="lower-content">
                                <div class="author-box">
                                    <div class="inner">
                                        <img src="assets/images/resource/author-3.png" alt="">
                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                        <span>For sell</span>
                                    </div>
                                </div>
                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                <h3>Villa on Grand Avenue </h3>
                            </div>
                        </div>
                    </div>
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/resource/feature-1.jpg" alt=""></figure>
                                <div class="shape"></div>
                                <div class="feature">Featured</div>
                                <div class="icon">
                                    <div class="icon-shape"></div>
                                    <i class="icon-16"></i>
                                </div>
                                <ul class="rating clearfix">
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><a href="index.php">(32)</a></li>
                                </ul>
                                <h5>$3,000.00</h5>
                            </div>
                            <div class="lower-content">
                                <div class="author-box">
                                    <div class="inner">
                                        <img src="assets/images/resource/author-1.png" alt="">
                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                        <span>For sell</span>
                                    </div>
                                </div>
                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                <h3>Villa on Grand Avenue </h3>
                            </div>
                        </div>
                    </div>
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/resource/feature-2.jpg" alt=""></figure>
                                <div class="shape"></div>
                                <div class="feature">Featured</div>
                                <div class="icon">
                                    <div class="icon-shape"></div>
                                    <i class="icon-16"></i>
                                </div>
                                <ul class="rating clearfix">
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><a href="index.php">(25)</a></li>
                                </ul>
                                <h5>$2,000.00</h5>
                            </div>
                            <div class="lower-content">
                                <div class="author-box">
                                    <div class="inner">
                                        <img src="assets/images/resource/author-2.png" alt="">
                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                        <span>For sell</span>
                                    </div>
                                </div>
                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                <h3>Villa on Grand Avenue </h3>
                            </div>
                        </div>
                    </div>
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/resource/feature-3.jpg" alt=""></figure>
                                <div class="shape"></div>
                                <div class="feature">Featured</div>
                                <div class="icon">
                                    <div class="icon-shape"></div>
                                    <i class="icon-16"></i>
                                </div>
                                <ul class="rating clearfix">
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><a href="index.php">(30)</a></li>
                                </ul>
                                <h5>$3,500.00</h5>
                            </div>
                            <div class="lower-content">
                                <div class="author-box">
                                    <div class="inner">
                                        <img src="assets/images/resource/author-3.png" alt="">
                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                        <span>For sell</span>
                                    </div>
                                </div>
                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                <h3>Villa on Grand Avenue </h3>
                            </div>
                        </div>
                    </div>
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/resource/feature-1.jpg" alt=""></figure>
                                <div class="shape"></div>
                                <div class="feature">Featured</div>
                                <div class="icon">
                                    <div class="icon-shape"></div>
                                    <i class="icon-16"></i>
                                </div>
                                <ul class="rating clearfix">
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><a href="index.php">(32)</a></li>
                                </ul>
                                <h5>$3,000.00</h5>
                            </div>
                            <div class="lower-content">
                                <div class="author-box">
                                    <div class="inner">
                                        <img src="assets/images/resource/author-1.png" alt="">
                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                        <span>For sell</span>
                                    </div>
                                </div>
                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                <h3>Villa on Grand Avenue </h3>
                            </div>
                        </div>
                    </div>
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/resource/feature-2.jpg" alt=""></figure>
                                <div class="shape"></div>
                                <div class="feature">Featured</div>
                                <div class="icon">
                                    <div class="icon-shape"></div>
                                    <i class="icon-16"></i>
                                </div>
                                <ul class="rating clearfix">
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><a href="index.php">(25)</a></li>
                                </ul>
                                <h5>$2,000.00</h5>
                            </div>
                            <div class="lower-content">
                                <div class="author-box">
                                    <div class="inner">
                                        <img src="assets/images/resource/author-2.png" alt="">
                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                        <span>For sell</span>
                                    </div>
                                </div>
                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                <h3>Villa on Grand Avenue </h3>
                            </div>
                        </div>
                    </div>
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/resource/feature-3.jpg" alt=""></figure>
                                <div class="shape"></div>
                                <div class="feature">Featured</div>
                                <div class="icon">
                                    <div class="icon-shape"></div>
                                    <i class="icon-16"></i>
                                </div>
                                <ul class="rating clearfix">
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><i class="icon-17"></i></li>
                                    <li><a href="index.php">(30)</a></li>
                                </ul>
                                <h5>$3,500.00</h5>
                            </div>
                            <div class="lower-content">
                                <div class="author-box">
                                    <div class="inner">
                                        <img src="assets/images/resource/author-3.png" alt="">
                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                        <span>For sell</span>
                                    </div>
                                </div>
                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                <h3>Villa on Grand Avenue </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- related-ads end -->


        <!-- subscribe-section -->
        <section class="subscribe-section">
            <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-9.png);"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                        <div class="text">
                            <div class="icon-box"><i class="icon-25"></i></div>
                            <h2>Subscribe to Newsletter</h2>
                            <p>and receive new ads in inbox</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                        <form action="https://azim.commonsupport.com/Clasifico/contact.html" method="post" class="subscribe-form">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Inout your email address" required="">
                                <button type="submit" class="theme-btn-one">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-section end -->


        <!-- main-footer -->
        <?php include 'footer.php' ?>
        <!-- main-footer end -->



        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="far fa-long-arrow-up"></span>
        </button>
    </div>


    <!-- jequery plugins -->
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
    <script src="assets/js/bxslider.js"></script>

    <!-- main-js -->
    <script src="assets/js/script.js"></script>

</body><!-- End of .page_wrapper -->

<!-- Mirrored from azim.commonsupport.com/Clasifico/browse-ads-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jul 2024 12:26:46 GMT -->
</html>

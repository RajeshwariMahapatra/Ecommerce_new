<!DOCTYPE html>
<html>
<head>
    <title>Best Store a Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Best Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //for-mobile-apps -->
    <link href="templates/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="templates/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- js -->
    <script src="templates/js/jquery.min.js"></script>
    <!-- //js -->
    <!-- cart -->
    <script src="templates/js/simpleCart.min.js"></script>
    <!-- cart -->
    <!-- for bootstrap working -->
    <script type="text/javascript" src="templates/js/bootstrap-3.1.1.min.js"></script>
    <!-- //for bootstrap working -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- timer -->
    <link rel="stylesheet" href="templates/css/jquery.countdown.css" />
    <!-- //timer -->
    <!-- animation-effect -->
    <link href="templates/css/animate.min.css" rel="stylesheet">
    <script src="templates/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->
</head>

<body>
    <!-- header -->
    <div class="header">
        <div class="container">
            <div class="header-grid">
                <div class="header-grid-left animated wow slideInLeft" data-wow-delay=".5s">
                    <ul>
                        <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">@example.com</a></li>
                        <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 892</li>
                        <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION['user_id'])) {
                            // User is logged in
                            echo '<li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href="index.php?action=logout">Logout</a></li>';
                        } else {
                            // User is not logged in
                            echo '<li><i class="glyphicon glyphicon-log-in" aria-hidden="true"></i><a href="index.php?action=login">Login</a></li>';
                            echo '<li><i class="glyphicon glyphicon-book" aria-hidden="true"></i><a href="index.php?action=register">Register</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="header-grid-right animated wow slideInRight" data-wow-delay=".5s">
                    <ul class="social-icons">
                        <li><a href="#" class="facebook"></a></li>
                        <li><a href="#" class="twitter"></a></li>
                        <li><a href="#" class="g"></a></li>
                        <li><a href="#" class="instagram"></a></li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="logo-nav">
                <div class="logo-nav-left animated wow zoomIn" data-wow-delay=".5s">
                    <h1><a href="index.php">Best Store <span>Shop anywhere</span></a></h1>
                </div>
                <div class="logo-nav-left1">
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header nav_2">
                            <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="index.php?action=home" class="act">Home</a></li>
                                <!-- Mega Menu -->
                                <li><a href="index.php?action=list_categories">Product Category</a></li>
                                <li><a href="index.php?action=furniture">Product List</a></li>
                                <li><a href="index.php?action=contact">Contact Us</a></li>
                                <li><a href="index.php?action=list_pages">Pages</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="logo-nav-right">
            <div class="search-box">
                <div id="sb-search" class="sb-search">
                    <form method="GET" action="index.php">
                        <input class="sb-search-input" placeholder="Enter your search term..." type="search" id="search" name="search">
                        <input type="hidden" name="action" value="furniture"> <!-- Include action as a hidden input -->
                        <input class="sb-search-submit" type="submit" value="">
                        <span class="sb-icon-search"> </span>
                    </form>
                </div>
            </div>
            <!-- search-scripts -->
            <script src="templates/js/classie.js"></script>
            <script src="templates/js/uisearch.js"></script>
            <script>
                new UISearch(document.getElementById('sb-search'));
            </script>
            <!-- //search-scripts -->
        </div>
        <div class="header-right">
            <div class="cart box_1">
                <a href="index.php?action=checkout">
                    <h3>
                        <div class="total">
                            <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)
                        </div>
                        <img src="templates/images/bag.png" alt="" />
                    </h3>
                </a>
                <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    </div>
    </div>

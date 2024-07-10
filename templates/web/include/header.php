

<!DOCTYPE html>
<html>

<head>
    <title>Lighting - E-commerce Category Flat Bootstrap Responsive Website Template | Login</title>
    <link href="templates/web/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom Theme files -->
    <!--theme style-->
    <link href="templates/web/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="templates/web/css/form.css" rel="stylesheet" type="text/css" media="all" />
    <link href="templates/web/css/flexslider.css" rel="stylesheet" type="text/css" media="all" />
    <link href="templates/web/css/memenu.css" rel="stylesheet" type="text/css" media="all" />
    <!--//theme style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Lighting Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free web designs for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
    <!-- start menu -->
    <script src="templates/web/js/jquery.min.js"></script>
    <script src="templates/web/js/imagezoom.js"></script>
    <script src="templates/web/js/simpleCart.min.js"></script>
    <script src="templates/web/js/bootstrap.js"></script>

    <!-- start menu -->
    <script type="text/javascript" src="templates/web/js/memenu.js"></script>

    <script>
        $(document).ready(function() {
            $(".memenu").memenu();
        });
    </script>
    <!-- /start menu -->
</head>

<body>
    <!--header-->
    <div class="header-top">
        <div class="header-bottom">
            <div class="logo">
                <h1><a href="users.php">Lighting</a></h1>
            </div>
            <div class="top-nav">
                <ul class="memenu skyblue">
                    <li class="active"><a href="users.php">Home</a></li>
                    <li class="grid"><a href="users.php?action=viewCategories">Categories</a>
                        <div class="mepanel">
                            <div class="row">
                                <div class="col1 me-one">
                                    <!-- <a href=""></a> -->
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="grid"><a href="users.php?action=viewProducts">Products</a></li>
                    <li class="grid"><a href="users.php?action=listPages">Pages</a></li>
                    <li class="grid"><a href="contact.html">Contact</a></li>
                </ul>
                <div class="clearfix"> </div>
            </div>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <!-- Show profile dropdown if logged in -->
                <div class="cart box_1 pull-right">
                    <a href="users.php?action=viewCart">
                        <div class="total">
                            <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span>)
                        </div>
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                    </a>
                    <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
                    <div class="clearfix"> </div>
                </div>
                <div class="dropdown profile-dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="templates/web/images/undraw_profile_1.svg" alt="Profile" class="img-circle" width="30" height="30">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="track_order.html">Track Your Order</a></li>
                        <li><a href="preferences.html">My Preferences</a></li>
                        <li><a href="users.php?action=userLogout">Logout</a></li>
                    </ul>
                </div>
            <?php else : ?>
                <!-- Show login button if not logged in -->
                <div class="cart box_1 pull-right">
                    <a href="users.php?action=viewCart">
                        <div class="total">
                            <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span>)
                        </div>
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                    </a>
                    <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
                    <div class="clearfix"> </div>
                </div>
                <div class="login-button pull-right">
                    <a href="users.php?action=userLogin" class="btn btn-default">Login</a>
                </div>
            <?php endif; ?>
            <div class="clearfix"> </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.profile-dropdown').hover(
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideDown('fast');
                    $(this).toggleClass('open');
                },
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideUp('fast');
                    $(this).toggleClass('open');
                }
            );
        });
    </script>
<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Asia/Kolkata" );
define( "DB_DSN", "mysql:host=localhost;dbname=ecommerce_new_db" );

define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "mypass" );
define( "PRODUCT_IMAGE_PATH", "images/products" );
define( "PRODUCT_IMAGE_URL", "images/products" );
require( CLASS_PATH . "/Pages.php" );
require( CLASS_PATH . "/ProductCategory.php" );
require( CLASS_PATH . "/Product.php" );
require( CLASS_PATH . "/Brand.php" );

// function handleException( $exception ) {
//     echo "Sorry, a problem occurred. Please try later.";
//     error_log( $exception->getMessage() );
//   }
  // set_exception_handler( 'handleException' );

?>
<?php
ini_set("display_errors", true);
date_default_timezone_set("Asia/Kolkata");
define("DB_DSN", "mysql:host=localhost;dbname=ecommerce_new_db");
define("DB_USERNAME", "root");
define("DB_PASSWORD", ""); // Change this to your actual database password if set
define("CLASS_PATH", "classes");
define("TEMPLATE_PATH", "templates");
define("TEMPLATE_PATH_web", "templates/web");
define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "mypass");
define("PRODUCT_IMAGE_PATH", "images/products/");
define("PRODUCT_IMAGE_URL", "images/products/");
define("COVER_IMAGE_PATH", "images/coverimage/");
define("COVER_IMAGE_URL", "images/coverimage/");

require(CLASS_PATH . "/Pages.php");
require(CLASS_PATH . "/ProductCategory.php");
require(CLASS_PATH . "/Product.php");
require(CLASS_PATH . "/Brand.php");
require(CLASS_PATH . "/Users.php");
require(CLASS_PATH . "/State.php");
require(CLASS_PATH . "/Country.php");
require(CLASS_PATH . "/Discounts.php");

function handleException($exception)
{
    echo "Sorry, a problem occurred. Please try later.";
    var_dump($exception->getMessage());
}
set_exception_handler('handleException');

try {
    $pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}
?>

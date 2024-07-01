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


require( CLASS_PATH . "/ProductCategory.php" );
require( CLASS_PATH . "/Product.php" );
require( CLASS_PATH . "/Brand.php" );

// require("config.php");
// Generate Alphanumeric String for all the tables
function generateRandomString($length = 12) {
    $alphanumeric = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $alphanumericLength = strlen($alphanumeric);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $alphanumeric[random_int(0, $alphanumericLength - 1)];
    }
    return $randomString;
}
function isUnique($string,$tableName,$columnName) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $stmt = $conn->prepare("SELECT COUNT(*) FROM $tableName WHERE $columnName = :value");
    $stmt->bindParam(':value',$string);
    $stmt->execute();
    return $stmt->fetchColumn() == 0;
}
function uniqueRandomString($length = 12,$tableName,$columnName) {
    do {
        $randomstring = generateRandomString($length);
    } while (!isUnique($randomstring,$tableName,$columnName));

    return $randomstring;
}


// $something = uniqueRandomString(12,'Users','user_identity');
// echo $something;

?>
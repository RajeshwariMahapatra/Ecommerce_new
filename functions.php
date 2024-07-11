<?php
require("config.php");
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

function calculateTotal() {
	$total = 0;
	if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
		foreach ($_SESSION['cart'] as $product) {
			$total += ($product['price'] * $product['quantity']);
		}
	}
	return $total;
}
function calculateGrandTotal() {
	$total = calculateTotal();
	$discount = 0; //add dynamicaly afterwards
	$deliveryCharges = 0.00; 
	$grandTotal = $total - ($total * ($discount / 100)) + $deliveryCharges;
	return $grandTotal;
}
// $something = uniqueRandomString(12,'Users','user_identity');
// echo $something;

?>
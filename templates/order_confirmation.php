<?php
include 'templates/include/user_header.php';
include 'config.php';

if (isset($_POST['place_order'])) {
    $delivery_address_line1 = $_POST['delivery_address_line1'];
    $delivery_address_line2 = $_POST['delivery_address_line2'];
    $delivery_city = $_POST['delivery_city'];
    $delivery_state_id = $_POST['delivery_state_id'];
    $delivery_country_id = $_POST['delivery_country_id'];
    $delivery_pin_code = $_POST['delivery_pin_code'];
    $order_notes = $_POST['order_notes'];
    $billing_name = $_POST['billing_name'];
    $billing_address = $_POST['billing_address'];
    $billing_email = $_POST['billing_email'];
    $billing_phone = $_POST['billing_phone'];
    $order_total = 100.00; // Placeholder value, calculate accordingly

    $stmt = $conn->prepare("INSERT INTO Orders (user_id, delivery_address_line1, delivery_address_line2, delivery_city, delivery_state_id, delivery_country_id, delivery_pin_code, billing_name, billing_address, billing_email, billing_phone, order_notes, order_total, order_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("isssiissssssssd", $_SESSION['user_id'], $delivery_address_line1, $delivery_address_line2, $delivery_city, $delivery_state_id, $delivery_country_id, $delivery_pin_code, $billing_name, $billing_address, $billing_email, $billing_phone, $order_notes, $order_total);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        echo "<div class='container'><h2>Order Confirmation</h2>";
        echo "<p>Thank you, your order has been placed successfully!</p>";
        echo "<p><strong>Order ID:</strong> " . htmlspecialchars($order_id) . "</p>";
        echo "<p><strong>Delivery Address Line 1:</strong> " . htmlspecialchars($delivery_address_line1) . "</p>";
        echo "<p><strong>Delivery Address Line 2:</strong> " . htmlspecialchars($delivery_address_line2) . "</p>";
        echo "<p><strong>City:</strong> " . htmlspecialchars($delivery_city) . "</p>";
        echo "<p><strong>State ID:</strong> " . htmlspecialchars($delivery_state_id) . "</p>";
        echo "<p><strong>Country ID:</strong> " . htmlspecialchars($delivery_country_id) . "</p>";
        echo "<p><strong>Pin Code:</strong> " . htmlspecialchars($delivery_pin_code) . "</p>";
        echo "<p><strong>Billing Name:</strong> " . htmlspecialchars($billing_name) . "</p>";
        echo "<p><strong>Billing Address:</strong> " . htmlspecialchars($billing_address) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($billing_email) . "</p>";
        echo "<p><strong>Phone Number:</strong> " . htmlspecialchars($billing_phone) . "</p>";
        echo "</div>";
    } else {
        echo "<div class='container'><h2>Order Failed</h2>";
        echo "<p>Sorry, there was an issue processing your order. Please try again.</p></div>";
    }

    $stmt->close();
}

include 'templates/include/user_footer.php';
?>

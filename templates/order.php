<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'templates/include/user_header.php'; ?>

<div class="container">
    <h2>Checkout</h2>
    <form action="index.php?order_confirmation" method="POST">
        <div class="form-group">
            <label for="address_line1">Delivery Address Line 1:</label>
            <input type="text" id="address_line1" name="delivery_address_line1" required>
        </div>
        <div class="form-group">
            <label for="address_line2">Delivery Address Line 2:</label>
            <input type="text" id="address_line2" name="delivery_address_line2">
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="delivery_city" required>
        </div>
        <div class="form-group">
            <label for="state">State ID:</label>
            <input type="number" id="state" name="delivery_state_id" required>
        </div>
        <div class="form-group">
            <label for="country">Country ID:</label>
            <input type="number" id="country" name="delivery_country_id" required>
        </div>
        <div class="form-group">
            <label for="pin_code">Pin Code:</label>
            <input type="text" id="pin_code" name="delivery_pin_code" required>
        </div>

        <div class="form-group">
            <label for="payment">Payment Method:</label>
            <select id="payment" name="payment_method" required>
                <option value="credit">Credit or Debit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cod">Cash on Delivery</option>
            </select>
        </div>

        <div class="form-group">
            <label>Shipping Method:</label>
            <div class="shipping-method">
                <input type="radio" id="standard" name="shipping_method" value="standard" required>
                <label for="standard">Standard Shipping (3-5 business days)</label>
            </div>
            <div class="shipping-method">
                <input type="radio" id="express" name="shipping_method" value="express">
                <label for="express">Express Shipping (1-2 business days)</label>
            </div>
        </div>

        <div class="form-group notes">
            <label for="notes">Order Notes (optional):</label>
            <textarea id="notes" name="order_notes" rows="4"></textarea>
        </div>

        <hr>

        <h3>Billing Information</h3>
        <div class="form-group">
            <label for="billingName">Billing Name:</label>
            <input type="text" id="billingName" name="billing_name" required>
        </div>
        <div class="form-group">
            <label for="billingAddress">Billing Address:</label>
            <textarea id="billingAddress" name="billing_address" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="billingEmail">Email Address:</label>
            <input type="email" id="billingEmail" name="billing_email" required>
        </div>
        <div class="form-group">
            <label for="billingPhone">Phone Number:</label>
            <input type="text" id="billingPhone" name="billing_phone" required>
        </div>

        <input type="submit" name="place_order" value="Place Your Order">
    </form>
</div>

<?php include 'templates/include/user_footer.php'; ?>

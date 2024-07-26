<?php include "templates/include/user_header.php" ?>

<div class="container">
    <h1><?php echo isset($results['pageTitle']) ? htmlspecialchars($results['pageTitle']) : "Order Page"; ?></h1>

    <?php if (isset($results['orderSuccess'])): ?>
        <div class="alert alert-success">
            Order placed successfully! 
                </div>
    <?php elseif (isset($results['orderError'])): ?>
        <div class="alert alert-danger">
            Error: <?php echo htmlspecialchars($results['orderError']); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=order" onsubmit="return validateForm()">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id ?? ''); ?>">

        <div class="form-group">
            <label for="delivery_address_line1">Delivery Address Line 1</label>
            <select class="form-control" id="delivery_address_line1" name="delivery_address_line1" required>
                <?php foreach ($results['addresses'] as $address): ?>
                    <option value="<?php echo htmlspecialchars($address->user_address_line1); ?>">
                        <?php echo htmlspecialchars($address->user_address_line1); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="delivery_address_line2">Delivery Address Line 2</label>
            <select class="form-control" id="delivery_address_line2" name="delivery_address_line2">
                <?php foreach ($results['addresses'] as $address): ?>
                    <option value="<?php echo htmlspecialchars($address->user_address_line2); ?>">
                        <?php echo htmlspecialchars($address->user_address_line2); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="delivery_city">Delivery City</label>
            <select class="form-control" id="delivery_city" name="delivery_city" required>
                <?php foreach ($results['addresses'] as $address): ?>
                    <option value="<?php echo htmlspecialchars($address->user_address_city); ?>">
                        <?php echo htmlspecialchars($address->user_address_city); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="delivery_state_id">Delivery State</label>
            <select class="form-control" id="delivery_state_id" name="delivery_state_id" required>
                <?php foreach ($results['states'] as $state): ?>
                    <option value="<?php echo $state->state_id; ?>" <?php echo ($state->state_id == ($results['user']->user_address_state_id ?? '')) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($state->state_name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="delivery_country_id">Delivery Country</label>
            <select class="form-control" id="delivery_country_id" name="delivery_country_id" required>
                <?php foreach ($results['countries'] as $country): ?>
                    <option value="<?php echo $country->country_id; ?>" <?php echo ($country->country_id == ($results['user']->user_address_country_id ?? '')) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($country->country_name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="delivery_pin_code">Delivery PIN Code</label>
            <input type="text" class="form-control" id="delivery_pin_code" name="delivery_pin_code" value="<?php echo htmlspecialchars($results['user']->user_address_pin_code ?? ''); ?>" required>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="sameAsDelivery" onclick="copyDeliveryToBilling()">
            <label class="form-check-label" for="sameAsDelivery">Same as delivery address</label>
        </div>

        <div class="form-group">
            <label for="billing_name">Billing Name</label>
            <input type="text" class="form-control" id="billing_name" name="billing_name" required>
        </div>

        <div class="form-group">
            <label for="billing_address">Billing Address</label>
            <textarea class="form-control" id="billing_address" name="billing_address" required></textarea>
        </div>

        <div class="form-group">
            <label for="billing_email">Billing Email</label>
            <input type="email" class="form-control" id="billing_email" name="billing_email" required oninput="validateEmail()">
            <div id="billing_email_error" class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label for="billing_phone">Billing Phone</label>
            <input type="tel" class="form-control" id="billing_phone" name="billing_phone" required oninput="validatePhone()">
            <div id="billing_phone_error" class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
            </select>
        </div>

        <div class="form-group">
            <label for="shipping_method">Shipping Method</label>
            <select class="form-control" id="shipping_method" name="shipping_method" required>
                <option value="Standard Shipping">Standard Shipping</option>
                <option value="Express Shipping">Express Shipping</option>
                <option value="Next Day Delivery">Next Day Delivery</option>
            </select>
        </div>

        <div class="form-group">
            <label for="order_notes">Order Notes</label>
            <textarea class="form-control" id="order_notes" name="order_notes"></textarea>
        </div>

        <div class="form-group">
            <label for="order_total">Order Total</label>
            <input type="number" class="form-control" id="order_total" name="order_total" value="<?php echo htmlspecialchars(isset($_SESSION['discounted_total']) ? $_SESSION['discounted_total'] : (isset($_COOKIE['discounted_total']) ? $_COOKIE['discounted_total'] : calculateTotal())); ?>" readonly>
        </div>

        <button type="submit" name="place_order" class="btn btn-primary">Place Order</button>
    </form>
</div>
<script>
// Real-time validation for Billing Email
document.getElementById('billing_email').addEventListener('input', function () {
    var emailField = document.getElementById('billing_email');
    if (emailField.validity.typeMismatch || emailField.value === "") {
        emailField.setCustomValidity('Please enter a valid email address.');
    } else {
        emailField.setCustomValidity('');
    }
});

// Real-time validation for Billing Phone
document.getElementById('billing_phone').addEventListener('input', function () {
    var phoneField = document.getElementById('billing_phone');
    if (phoneField.validity.patternMismatch || phoneField.value === "") {
        phoneField.setCustomValidity('Please enter a valid 10-digit phone number.');
    } else {
        phoneField.setCustomValidity('');
    }
});

function copyDeliveryToBilling() {
    var checkbox = document.getElementById("sameAsDelivery");
    var deliveryAddressLine1 = document.getElementById("delivery_address_line1");
    var deliveryAddressLine2 = document.getElementById("delivery_address_line2");
    var deliveryCity = document.getElementById("delivery_city");

    var billingAddress = document.getElementById("billing_address");
    var billingCity = document.getElementById("billing_city");

    if (checkbox.checked) {
        billingAddress.value = deliveryAddressLine1.value + ", " + deliveryAddressLine2.value + ", " + deliveryCity.value;
        billingCity.value = deliveryCity.value;
    } else {
        billingAddress.value = "";
        billingCity.value = "";
    }
}

document.getElementById('billing_email').oninput = function() {
        var email = this.value;
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var emailError = document.getElementById('emailError');
        if (!emailPattern.test(email)) {
            emailError.style.display = 'block';
        } else {
            emailError.style.display = 'none';
        }
    };

    document.getElementById('billing_phone').oninput = function() {
        var phone = this.value;
        var phonePattern = /^[0-9]{10}$/;
        var phoneError = document.getElementById('phoneError');
        if (!phonePattern.test(phone)) {
            phoneError.style.display = 'block';
        } else {
            phoneError.style.display = 'none';
        }
    };
</script>
<?php include "templates/include/user_footer.php" ?>

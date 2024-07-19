<?php include 'templates/include/user_header.php' ?>
<!-- //header -->
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.php?action=home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Register</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- register -->
<div class="register">
    <div class="container">
        <h2>Register Here</h2>
        <div class="login-form-grids">
            <h5>Profile Information</h5>
            <form action="index.php?action=register" method="post">
                <input type="text" name="username" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="country_code" placeholder="Country Code" required>
                <input type="text" name="contact_no" placeholder="Contact Number" required>
                <input type="date" name="birthdate" placeholder="Birthdate" required>
                <input type="text" name="address_line1" placeholder="Address Line 1" required>
                <input type="text" name="address_line2" placeholder="Address Line 2">
                <input type="text" name="city" placeholder="City" required>
                <select name="state_id" required>
                    <option value="">Select State</option>
                    <!-- PHP to dynamically generate state options -->
                    <?php
                    foreach ($results['states'] as $state) {
                        echo '<option value="' . htmlspecialchars($state->state_id) . '">' . htmlspecialchars($state->state_name) . '</option>';
                    }
                    ?>
                </select>
                <select name="country_id" required>
                    <option value="">Select Country</option>
                    <!-- PHP to dynamically generate country options -->
                    <?php
                    foreach ($results['countries'] as $country) {
                        echo '<option value="' . htmlspecialchars($country->country_id) . '">' . htmlspecialchars($country->country_name) . '</option>';
                    }
                    ?>
                </select>
                <input type="text" name="pin_code" placeholder="Postal Code" required>
                <input type="submit" name="register" value="Register">
            </form>
        </div>
        <div class="register-home">
            <a href="index.php?action=home">Home</a>
        </div>
    </div>
</div>
<!-- //register -->
<!-- footer -->
<?php include 'templates/include/user_footer.php' ?>

<style>
    .register {
        padding: 50px 0;
    }
    .register h2 {
        font-size: 30px;
        margin-bottom: 30px;
        text-align: center;
        font-weight: bold;
        color: #333;
    }
    .login-form-grids {
        max-width: 600px;
        margin: 0 auto;
    }
    .login-form-grids input[type="text"],
    .login-form-grids input[type="email"],
    .login-form-grids input[type="password"],
    .login-form-grids input[type="date"],
    .login-form-grids select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
        color: #333;
    }
    .login-form-grids input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #5cb85c;
        font-size: 18px;
        color: white;
        cursor: pointer;
    }
    .login-form-grids input[type="submit"]:hover {
        background-color: #4cae4c;
    }
    .register-home {
        text-align: center;
        margin-top: 20px;
    }
    .register-home a {
        color: #5cb85c;
        text-decoration: none;
        font-size: 16px;
    }
    .register-home a:hover {
        text-decoration: underline;
    }
</style>

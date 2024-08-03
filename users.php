<?php
// require("config.php");
require("functions.php");
session_name('user_session'); // For user section
session_start();

$action = isset($_GET['action']) ? $_GET['action'] : "";
switch ($action) {
    case "userRegister":
        userRegister();
        break;
    case "userLogin":
        userLogin();
        break;
    case "userLogout":
        userLogout();
        break;
    case "viewProducts":
        viewProducts();
        break;
    case "viewProductDetails":
        viewProductDetails();
        break;
    case "viewCategories":
        viewCategories();
        break;
        // case "viewCategoryProducts":
        //     viewCategoryProducts();
        //     break;
    case "listPages":
        listPages();
        break;
    case "viewPages":
        viewPages();
        break;
    case "addToCart":
        addToCart($_POST['product_id'], $_POST['product_name'], $_POST['product_selling_price'], $_POST['quantity']);
        header("Location: users.php?action=viewProducts");
        break;
    case "removeFromCart":
        removeFromCart($_POST['product_id']);
        header("Location: users.php?action=viewCart");
        break;
    case "updateCart":
        updateCart($_POST['product_id'], $_POST['quantity']);
        header("Location: users.php?action=viewCart");
        break;
    case "viewCart":
        viewCart();
        break;
    default:
        homepage();
        break;
}

function userRegister()
{

    $results = array();
    $results['pageTitle'] = "Add Users";
    $results['formAction'] = "addUsers";
    if (isset($_POST["saveChanges"])) {

        $_POST['user_identity'] = uniqueRandomString(12, 'Users', 'user_identity');
        $_POST['user_password'] = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
        $user = new Users;
        $user->storeFormValues($_POST);
        $user->insert();
        header("Location: users.php?action=homepage");
    } elseif (isset($_POST['cancel'])) {

        header("Location: users.php?action=userRegister");
    } else {

        $results['user'] = new Users;
        $results['states'] = State::getList()['results'];
        $results['countries'] = Country::getList()['results'];
        require(TEMPLATE_PATH_web . "/account.php");
    }
}
function userLogin()
{
    // session_start();

    $results = array();
    if (isset($_POST['saveChanges'])) {
        if (isset($_POST['user_email']) && isset($_POST['user_password'])) {
            $email = $_POST['user_email'];
            $password = $_POST['user_password'];

            $user = Users::getByEmail($email);

            if ($user && password_verify($password, $user->user_password)) {
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['user_email'] = $user->user_email;
                $_SESSION['user_name'] = $user->user_name;

                loadCartFromCookies();

                // echo "successfully login";
                // require(TEMPLATE_PATH_web . "/login.php");
                header("Location: users.php?action=homepage");
                exit();
            } else {
                $results['error'] = "Invalid email or password. Please try again.";
                require(TEMPLATE_PATH_web . "/login.php");
                exit();
            }
        } else {
            $results['error'] = "Email and password are required.";
            require(TEMPLATE_PATH_web . "/login.php");
            exit();
        }
    } else {
        $results["pageTitle"] = "User Login";
        require(TEMPLATE_PATH_web . "/login.php");
    }
}
function userLogout()
{
    session_start(); // Ensure session is started
    $_SESSION = array(); // Unset all session variables
    header("Location: users.php?action=homepage"); // Redirect to home page
    exit;
}
function viewProducts()
{

    $results = array();
    global $pdo;

    if (isset($_GET['category_id']) && $_GET['category_id'] != '') {

        $category_id = intval($_GET['category_id']);
        $product = new Product();
        $productsByCategory = $product->getProductsByCategory($category_id, $pdo);
        $results['products'] = $productsByCategory;
    } else {
        $data = Product::getList();
        $results["products"] = $data['results'];
        $results["totalRows"] = $data['totalRows'];
    }

    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "View Categories";
    // echo "<pre>";
    // var_dump($results);

    require(TEMPLATE_PATH_web . "/product.php");
}
function viewProductDetails()
{
    // $_GET = [
    //     "product_id" => "1",
    // ];

    if (!isset($_GET["product_id"]) || !$_GET["product_id"]) {
        homepage();
        return;
    }

    $results = array();
    $results['product'] = Product::getById((int)$_GET["product_id"]);
    $results["pageTitle"] = $results['product']->product_name;

    $results['brand'] = Brand::getById($results['product']->product_brand_id);


    $data = Product::getList();
    $results["products"] = $data['results'];
    $results["totalRows"] = $data['totalRows'];
    $results["pageTitle"] = 'Products List';

    // echo "<pre>";
    // var_dump($results);
    require(TEMPLATE_PATH_web . "/single.php");
}

// function viewCategoryProducts()
// {

//     $_GET = [
//         "category_id" => 2,
//     ];

//     $results = array();
//     $results['products'] = Product::getByCategoryId($_GET['category_id']);
//     // $results["pageTitle"]='Products List';
//     echo "<pre>";
//     var_dump($results);

//     if (empty($results['products'])) {
//         echo "<p>No products found in this category.</p>";
//     }
// }

function viewCategories()
{
    $results = array();
    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "View Categories";
    // var_dump($results) ;
    // return $results;
    require(TEMPLATE_PATH_web . "/categories.php");
}

function listPages()
{

    $results = array();
    $data = Pages::getList();
    $results["pages"] = $data["results"];
    $results["totalPagesRows"] = $data["totalRows"];
    $results["pageTitle"] = "Pages";

    require(TEMPLATE_PATH_web . "/pages.php");
}

function viewPages()
{

    $results = array();

    $pageData = Pages::getList();
    $results['pages'] = $pageData['results'];
    $results['totalPagesRows'] = $pageData['totalRows'];


    if (isset($_GET['page_id'])) {
        $page_id = $_GET['page_id'];
        $page = Pages::getById($page_id);
        if ($page) {
            $results['page'] = $page;
            require(TEMPLATE_PATH_web . "/viewPages.php");
        } else {
            // Handle page not found
        }
    } else {
        // Handle default or home page
        require(TEMPLATE_PATH_web . "/users.php");
    }
}
function addToCart($productId, $productName, $productPrice, $quantity) {
    $productDetails = Product::getById($productId);
    $product = array(
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'quantity' => $quantity,
        'image' => $productDetails->product_product_image_1,
        'productCode' => $productDetails->product_code
    );

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $productExists = false;
    foreach ($_SESSION['cart'] as &$cartProduct) {
        if ($cartProduct['id'] == $productId) {
            $cartProduct['quantity'] += $quantity;
            $productExists = true;
            break;
        }
    }

    if (!$productExists) {
        $_SESSION['cart'][] = $product;
    }

    saveCartToCookies();
    applyDiscountToTotal();
}

function updateCart($productId, $newQuantity) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$product) {
            if ($product['id'] == $productId) {
                $product['quantity'] = $newQuantity;
                break;
            }
        }
    }
    saveCartToCookies();
    applyDiscountToTotal();
}

function removeFromCart($productId)
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['id'] == $productId) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }
    saveCartToCookies();
}

function removeDiscount() {
    // Unset session variables
    unset($_SESSION['applied_discount']);
    unset($_SESSION['discounted_total']);
    
    // Expire cookies
    setcookie('discounted_total', '', time() - 3600, '/');
    setcookie('applied_discount', '', time() - 3600, '/');

    // Redirect back to the checkout page
    header("Location: index.php?action=checkout");
    exit();
}

function saveCartToCookies() {
    setcookie('cart', json_encode($_SESSION['cart']), time() + (86400 * 30), '/');
    if (isset($_SESSION['applied_discount'])) {
        setcookie('applied_discount', json_encode($_SESSION['applied_discount']), time() + (86400 * 30), '/');
    } else {
        setcookie('applied_discount', '', time() - 3600, '/'); // Remove the discount cookie if no discount is applied
    }
}

function loadCartFromCookies() {
    if (isset($_COOKIE['cart'])) {
        $_SESSION['cart'] = json_decode($_COOKIE['cart'], true);
    } else {
        $_SESSION['cart'] = array();
    }

    if (isset($_COOKIE['applied_discount'])) {
        $_SESSION['applied_discount'] = json_decode($_COOKIE['applied_discount']);
    } else {
        unset($_SESSION['applied_discount']);
    }

    applyDiscountToTotal();
}

function applyDiscountToTotal() {
    $order_total = calculateTotal(); // Calculate the total of the cart

    // Debugging: Check order total before applying discount
    // echo "Order total before discount: $order_total<br>";

    if (isset($_SESSION['applied_discount'])) {
        $discount = (object)$_SESSION['applied_discount']; // Cast to object

        // Debugging: Check the discount details
        // echo "Applying discount: " . print_r($discount, true) . "<br>";

        // Ensure all necessary properties are present
        if (isset($discount->start_date, $discount->end_date, $discount->discount_type, $discount->discount_value, $discount->minimum_order_value, $discount->usage_limit)) {
            // Check if discount code is within valid date range
            $current_time = time();
            $start_date = strtotime($discount->start_date);
            $end_date = strtotime($discount->end_date);

            // Debugging: Check current time and discount date range
            // echo "Current time: " . date('Y-m-d H:i:s', $current_time) . "<br>";
            // echo "Discount start date: " . date('Y-m-d H:i:s', $start_date) . "<br>";
            // echo "Discount end date: " . date('Y-m-d H:i:s', $end_date) . "<br>";

            // Initialize times_used if it is NULL
            if (is_null($discount->times_used)) {
                $discount->times_used = 0;
            }

            // echo "Times used: " . $discount->times_used . "<br>";

            if ($current_time >= $start_date && $current_time <= $end_date) {
                // Check if discount code has not exceeded its usage limit
                if ($discount->times_used < $discount->usage_limit) {
                    // Check if order total meets the minimum requirement
                    if ($order_total >= $discount->minimum_order_value) {
                        // Apply discount based on type
                        if ($discount->discount_type === 'percentage') {
                            $_SESSION['discounted_total'] = $order_total - ($discount->discount_value / 100 * $order_total);
                        } elseif ($discount->discount_type === 'fixed') {
                            $_SESSION['discounted_total'] = $order_total - $discount->discount_value;
                        }

                        // Increment the times_used
                        $discount->times_used++;
                        $_SESSION['applied_discount']->times_used = $discount->times_used;

                        // Debugging: Check discounted total after applying discount
                        // echo "Discounted total after applying discount: " . $_SESSION['discounted_total'] . "<br>";
                    } else {
                        // Minimum order requirement not met, set discounted total to order total
                        $_SESSION['discounted_total'] = $order_total;
                        // echo "Minimum order requirement not met. Discount not applied.<br>";
                    }
                } else {
                    // Usage limit exceeded, set discounted total to order total
                    $_SESSION['discounted_total'] = $order_total;
                    // echo "Discount code usage limit exceeded. Discount not applied.<br>";
                }
            } else {
                // Discount code is not currently valid, set discounted total to order total
                $_SESSION['discounted_total'] = $order_total;
                // echo "Discount code is not valid currently. Discount not applied.<br>";
            }
        } else {
            echo "Discount data is missing required properties.<br>";
        }
    } else {
        // No discount applied, set discounted total to order total
        $_SESSION['discounted_total'] = $order_total;
        // echo "No discount applied.<br>";
    }
}

function applyDiscount() {
    if (isset($_POST['discount_code'])) {
        $discount_code = $_POST['discount_code'];
        $discount = Discounts::getByCode($discount_code);

        if ($discount) {
            // Ensure all necessary properties are present
            if (isset($discount->start_date, $discount->end_date, $discount->discount_type, $discount->discount_value, $discount->minimum_order_value, $discount->usage_limit, $discount->times_used)) {
                echo "Discount fetched: " . print_r($discount, true);

                $order_total = calculateTotal();

                if ($order_total >= $discount->minimum_order_value) {
                    if ($discount->usage_limit == 0 || $discount->times_used < $discount->usage_limit) {
                        if ($discount->discount_type == 'percentage') {
                            $discount_amount = $order_total * ($discount->discount_value / 100);
                        } else if ($discount->discount_type == 'fixed') {
                            $discount_amount = $discount->discount_value;
                        }
                        $new_order_total = $order_total - $discount_amount;
                        echo "Discount applied. New order total: " . $new_order_total;

                        // Update the session and cookies
                        $_SESSION['applied_discount'] = $discount;
                        $_SESSION['discounted_total'] = $new_order_total;
                        setcookie('discounted_total', $new_order_total, time() + (86400 * 30), '/');
                        setcookie('applied_discount', json_encode($discount), time() + (86400 * 30), '/');

                        // Update the times_used in the database
                        $discount->times_used++;
                        $discount->update();
                    } else {
                        echo "Discount usage limit reached.";
                    }
                } else {
                    echo "Order total does not meet the minimum order value.";
                }
            } else {
                echo "Discount fetched but missing required properties.";
            }
        } else {
            echo "Discount not found or not valid.";
        }
    }
}

function calculateGrandTotal() {
    $total = calculateTotal();
    $deliveryCharges = 0.00; // Assuming no delivery charges for now

    // Debugging: Check if discounted total exists in the session
    echo "Discounted total in session: " . (isset($_SESSION['discounted_total']) ? $_SESSION['discounted_total'] : 'Not Set') . "<br>";

    if (isset($_SESSION['discounted_total'])) {
        $grandTotal = $_SESSION['discounted_total'] + $deliveryCharges;
    } else {
        $grandTotal = $total + $deliveryCharges;
    }

    return $grandTotal;
}

function viewCart()
{
    $results = array();
    $results['pageTitle'] = "View Cart";

    require(TEMPLATE_PATH_web . "/checkout.php");
}
function homepage()
{
    $results = array();
    $data = Product::getList();
    $results['products'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Ecommerce";

    // echo "Hello this is my homepage";
    require(TEMPLATE_PATH_web . "/index.php");
}

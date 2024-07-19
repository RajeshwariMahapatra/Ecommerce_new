<?php
require("functions.php");
session_start();
// Unset the session variable related to the discounted price if it exists
if (isset($_SESSION['discounted_price'])) {
    unset($_SESSION['discounted_price']);
}
$action = isset($_GET['action']) ? $_GET['action'] : "";

switch ($action) {
    case 'checkout':
        checkout();
        break;
    case 'furniture':
        furniture();
        break;
    case 'login':
        login();
        break;
    case 'contact':
        contact();
        break;
    case 'products':
        products();
        break;
    case 'register':
        register();
        break;
    case 'single':
        single();
        break;
    case 'temporary':
        temporary();
        break;
    case 'list_pages':
        list_pages();
        break;
    case 'list_categories':
        list_categories();
        break;
    case "addToCart":
        addToCart($_POST['product_id'], $_POST['product_name'], $_POST['product_selling_price'], $_POST['quantity']);
        header("Location: index.php?action=furniture");
        break;
    case "removeFromCart":
        removeFromCart($_POST['product_id']);
        header("Location: index.php?action=checkout");
        break;
    case "updateCart":
        updateCart($_POST['product_id'], $_POST['quantity']);
        header("Location: index.php?action=checkout");
        break;
    case 'applyDiscountToTotal':
        applyDiscountToTotal();
        header("Location: index.php?action=checkout");
        break;
    case 'applyDiscount':
        applyDiscount();
        header("Location: index.php?action=checkout");
        break;
    case 'calculateGrandTotal':
        calculateGrandTotal();
        break;
    case 'logout':
        logout();
        break;
    default:
        home();
}
function logout()
{
    session_start(); // Ensure session is started

    // Unset the session variable related to the discounted price
    if (isset($_SESSION['discounted_price'])) {
        unset($_SESSION['discounted_price']);
    }

    session_destroy(); // Destroy the session (if necessary)
    
    // Redirect to home page
    header("Location: index.php?action=home");
    exit;
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

function removeFromCart($productId) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['id'] == $productId) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }
    saveCartToCookies();
    applyDiscountToTotal();
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
    if (isset($_SESSION['applied_discount'])) {
        $discount = $_SESSION['applied_discount'];

        // Check if discount code is within valid date range
        $current_time = time();
        $start_date = strtotime($discount->start_date);
        $end_date = strtotime($discount->end_date);

        if ($current_time >= $start_date && $current_time <= $end_date) {
            // Check if order total meets the minimum requirement
            if ($order_total >= $discount->minimum_order_value) {
                // Apply discount based on type
                if ($discount->discount_type === 'percentage') {
                    $_SESSION['discounted_total'] = $order_total - ($discount->discount_value / 100 * $order_total);
                } elseif ($discount->discount_type === 'fixed') {
                    $_SESSION['discounted_total'] = $order_total - $discount->discount_value;
                }
            } else {
                // Minimum order requirement not met, set discounted total to order total
                $_SESSION['discounted_total'] = $order_total;
            }
        } else {
            // Discount code is not currently valid, set discounted total to order total
            $_SESSION['discounted_total'] = $order_total;
        }
    } else {
        // No discount applied, set discounted total to order total
        $_SESSION['discounted_total'] = $order_total;
    }
}


function applyDiscount() {
    if (isset($_POST['apply_discount'])) {
        $discount_code = $_POST['discount_code'];

        // Check if discount code exists and is valid
        $discount = Discounts::getByCode($discount_code);

        if ($discount) {
            // Fetch discount details
            $start_date = strtotime($discount->start_date);
            $end_date = strtotime($discount->end_date);
            $current_time = time();

            // Check if discount code is within valid date range
            if ($current_time >= $start_date && $current_time <= $end_date) {
                // Store discount in session
                $_SESSION['applied_discount'] = $discount;
                saveCartToCookies();
                // Apply discount to total
                applyDiscountToTotal();
            } else {
                // Discount code is not currently valid
                echo "Discount code is not currently valid.";
            }
        } else {
            // Handle invalid discount code scenario
            echo "Invalid discount code. Please try again.";
        }
    }
}


function calculateGrandTotal() {
    $total = calculateTotal();
    $deliveryCharges = 0.00; // Assuming no delivery charges for now

    if (isset($_SESSION['discounted_total'])) {
        $grandTotal = $_SESSION['discounted_total'] + $deliveryCharges;
    } else {
        $grandTotal = $total + $deliveryCharges;
    }

    return $grandTotal;
}

function checkout() {
    $results = array();

    $pageData = Pages::getList();
    $results['pages'] = $pageData['results'];
    $results['totalPagesRows'] = $pageData['totalRows'];

    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "Checkout | Ecommerce";
    
    // Ensure the cart and discount data is loaded
    loadCartFromCookies();
    
    // Unset the discounted total if it exists
    if (isset($_SESSION['discounted_total'])) {
        unset($_SESSION['discounted_total']);
    }
    
    // Apply discount to total again
    applyDiscountToTotal();

    require(TEMPLATE_PATH . "/checkout.php");
}

function furniture()
{
    $results = array();

    $pageData = Pages::getList();
    $results['pages'] = $pageData['results'];
    $results['totalPagesRows'] = $pageData['totalRows'];

    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $data = Product::getListSearchSort(1000000, $search, $sort);

    $results['products'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "Furniture | Ecommerce";
    
    // Unset the discounted total if it exists
    if (isset($_SESSION['discounted_total'])) {
        unset($_SESSION['discounted_total']);
    }
    
    // Apply discount to total again
    applyDiscountToTotal();

    require(TEMPLATE_PATH . "/furniture.php");
}


function login()
{
    // session_start();

    // Check if user is already logged in
    if (isset($_SESSION['user_id'])) {
        // User is already logged in, redirect to home page or another appropriate page
        header("Location: index.php?action=home");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Get user by email
        $user = Users::getByEmail($email);

        if ($user && password_verify($password, $user->user_password)) {
            // Email and password match
            $_SESSION['user_id'] = $user->user_id;
            $_SESSION['user_name'] = $user->user_name;
            $_SESSION['success_message'] = "You have successfully logged in.";
            loadCartFromCookies();
            header("Location: index.php?action=home");
            exit;
        } else {
            // Invalid login
            $error = "Invalid email or password.";
            $_SESSION['error_message'] = $error;
            header("Location: index.php?action=login");
            exit;
        }
    }

    // Display login form if not logged in
    $results['pageTitle'] = "Login | Ecommerce";
    require(TEMPLATE_PATH . "/login.php");
}


function contact()
{
    $results = array();

    $pageData = Pages::getList();
    $results['pages'] = $pageData['results'];
    $results['totalPagesRows'] = $pageData['totalRows'];

    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "Contact | Ecommerce";
    require(TEMPLATE_PATH . "/contact.php");
}

function products()
{
    $results = array();

    // Fetch all products by default
    $data = Product::getList();
    $results['products'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];

        // Assuming $pdo is your PDO object from database connection
        global $pdo;

        // Instantiate Product object
        $product = new Product();

        // Call non-static method on the instance
        $productsByCategory = $product->getProductsByCategory($category_id, $pdo);

        if ($productsByCategory) {
            $results['products'] = $productsByCategory;
            require(TEMPLATE_PATH . "/products.php");
        } else {
            echo "No products found for this category"; // Debugging output
        }
    } else {
        echo "No category ID provided"; // Debugging output
        // Handle default or home page
        require(TEMPLATE_PATH . "/home.php");
    }
}

function register() {
    $results = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['country_code'], $_POST['contact_no'], $_POST['birthdate'], $_POST['address_line1'], $_POST['city'], $_POST['state_id'], $_POST['country_id'], $_POST['pin_code'])) {
            // Debugging
            echo "Form data received successfully.<br>";
            echo "Username: " . htmlspecialchars($_POST['username']) . "<br>";
            echo "Email: " . htmlspecialchars($_POST['email']) . "<br>";
            echo "Password: " . htmlspecialchars($_POST['password']) . "<br>";
            echo "Country Code: " . htmlspecialchars($_POST['country_code']) . "<br>";
            echo "Contact No: " . htmlspecialchars($_POST['contact_no']) . "<br>";
            echo "Birthdate: " . htmlspecialchars($_POST['birthdate']) . "<br>";

            $user = new Users();
            $user->user_identity = uniqueRandomString(12, 'Users', 'user_identity'); // Generating unique identifier
            $user->user_name = $_POST['username'];
            $user->user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->user_email = $_POST['email'];
            $user->user_country_code = $_POST['country_code'];
            $user->user_contact_no = $_POST['contact_no'];
            $user->user_birthdate = $_POST['birthdate'];
            $user->user_address_line1 = $_POST['address_line1'];
            $user->user_address_line2 = isset($_POST['address_line2']) ? $_POST['address_line2'] : '';
            $user->user_address_city = $_POST['city'];
            $user->user_address_state_id = $_POST['state_id'];
            $user->user_address_country_id = $_POST['country_id'];
            $user->user_address_pin_code = $_POST['pin_code'];
            $user->user_created_at = time(); // Current timestamp
            $user->user_status = 1; // Assuming new users are active by default

            // Debugging
            echo "Generated user identity: " . $user->user_identity . "<br>";
            echo "Hashed Password: " . $user->user_password . "<br>";

            try {
                $user->insert();
                echo "User inserted successfully.<br>";
                // Redirect to login page after successful registration
                header("Location: index.php?action=login");
                exit;
            } catch (Exception $e) {
                echo "Error registering user: " . $e->getMessage();
            }
        } else {
            $results['errorMessage'] = "Please fill in all required fields.";
        }
    }

    // Fetch states and countries for dropdowns
    $state = new State();
    $country = new Country();
    $results['states'] = $state->getStates();
    $results['countries'] = $country->getCountries();

    $results['pageTitle'] = "Register | Ecommerce";
    require(TEMPLATE_PATH . "/register.php");
}

function single()
{
    $results = array();

    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];

    $data = Product::getList();
    $results['singles'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    $data = Product::getById($_GET['product_id']);
    $results['articles'] = $data;
    $product = $results['articles'];
    $results['pageTitle'] = "Single | Ecommerce";
    require(TEMPLATE_PATH . "/single.php");
}

function temporary()
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
            require(TEMPLATE_PATH . "/temporary.php");
        } else {
            // Handle page not found
        }
    } else {
        // Handle default or home page
        require(TEMPLATE_PATH . "/home.php");
    }
}

function list_pages()
{
    $results = array();

    $pageData = Pages::getList();
    $results['pages'] = $pageData['results'];
    $results['totalPagesRows'] = $pageData['totalRows'];
    $results['pageTitle'] = "List Pages | Ecommerce";
    require(TEMPLATE_PATH . "/list_pages.php");
}

function list_categories()
{
    $results = array();

    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "List Categories | Ecommerce";
    require(TEMPLATE_PATH . "/list_categories.php");
}

function home()
{
    $results = array();

    $pageData = Pages::getList();
    $results['pages'] = $pageData['results'];
    $results['totalPagesRows'] = $pageData['totalRows'];

    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];

    $data = Product::getList();
    $results['articles'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    $results['pageTitle'] = "Ecommerce";
    require(TEMPLATE_PATH . "/home.php");
}
<?php
// session_start();
// require("config.php");
require("functions.php");
session_start();

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
    // case "calculateTotal":
    //     calculateTotal($_POST['product_id'], $_POST['quantity']);
    //     header("Location: index.php?action=checkout");
    //     break;
    // case "calculateGrandTotal":
    //     calculateGrandTotal($_POST['product_id'], $_POST['quantity']);
    //     header("Location: index.php?action=checkout");
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
    $_SESSION = array(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php?action=home"); // Redirect to home page
    exit;
}
function addToCart($productId, $productName, $productPrice, $quantity)
{
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
}

function updateCart($productId, $newQuantity)
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$product) {
            if ($product['id'] == $productId) {
                $product['quantity'] = $newQuantity;
                break;
            }
        }
    }
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
}

function checkout()
{
    $results = array();

    $pageData = Pages::getList();
    $results['pages'] = $pageData['results'];
    $results['totalPagesRows'] = $pageData['totalRows'];

    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "Checkout | Ecommerce";
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



function register()
{
    $results = array();

    $categoryData = ProductCategory::getList();
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
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

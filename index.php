<?php
require( "config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
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
  default:
    home();
}

function checkout() {
    $results = array();
    $categoryData = ProductCategory::getList(); // Assuming Category::getList() returns an array with 'results' and 'totalRows'
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "Checkout | Ecommerce";
    require(TEMPLATE_PATH . "/checkout.php");
  }
  
  function furniture() {
    
    $results = array();
    $data = Product::getList(); // Assuming Product::getList() returns an array with 'results' and 'totalRows'
    $results['products'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $categoryData = ProductCategory::getList(); // Assuming Category::getList() returns an array with 'results' and 'totalRows'
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "Furniture | Ecommerce";
    require(TEMPLATE_PATH . "/furniture.php");
    
}

  
  function login() {
    $results = array();
    $categoryData = ProductCategory::getList(); // Assuming Category::getList() returns an array with 'results' and 'totalRows'
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "Login | Ecommerce";
    require(TEMPLATE_PATH . "/login.php");
  }
  
  function contact() {
    $results = array();
    $categoryData = ProductCategory::getList(); // Assuming Category::getList() returns an array with 'results' and 'totalRows'
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "Contact | Ecommerce";
    require(TEMPLATE_PATH . "/contact.php");
  }
  
  function products() {
    $results = array();
    $categoryData = ProductCategory::getList(); // Assuming Category::getList() returns an array with 'results' and 'totalRows'
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $data = Product::getList(); // Assuming Product::getList() returns an array with 'results' and 'totalRows'
    $results['products'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Products | Ecommerce";
    require(TEMPLATE_PATH . "/products.php");
  }
  
  function register() {
    $results = array();
    $categoryData = ProductCategory::getList(); // Assuming Category::getList() returns an array with 'results' and 'totalRows'
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $results['pageTitle'] = "Register | Ecommerce";
    require(TEMPLATE_PATH . "/register.php");
  }
  
  function single() {
    $results = array();
    $categoryData = ProductCategory::getList(); // Assuming Category::getList() returns an array with 'results' and 'totalRows'
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $data = Product::getList();
     // Assuming Product::getList() returns an array with 'results' and 'totalRows'
    $results['articles'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Single | Ecommerce";
    require(TEMPLATE_PATH . "/single.php");
  }

  function home() {
    $results = array();
    $categoryData = ProductCategory::getList(); // Assuming Category::getList() returns an array with 'results' and 'totalRows'
    $results['categories'] = $categoryData['results'];
    $results['totalCategoryRows'] = $categoryData['totalRows'];
    $data = Product::getList();
     // Assuming Product::getList() returns an array with 'results' and 'totalRows'
    $results['articles'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    // var_dump($data);
    $results['pageTitle'] = "Ecommerce";
    require(TEMPLATE_PATH . "/home.php");
}


?>

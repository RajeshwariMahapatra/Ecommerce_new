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
  case 'mail':
    mail();
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
    $results['pageTitle'] = "Checkout | Ecommerce";
    require(TEMPLATE_PATH . "/checkout.php");
  }
  
  function furniture() {
    $results = array();
    $results['pageTitle'] = "Furniture | Ecommerce";
    require(TEMPLATE_PATH . "/furniture.php");
  }
  
  function login() {
    $results = array();
    $results['pageTitle'] = "Login | Ecommerce";
    require(TEMPLATE_PATH . "/login.php");
  }
  
  function mail() {
    $results = array();
    $results['pageTitle'] = "Mail | Ecommerce";
    require(TEMPLATE_PATH . "/mail.php");
  }
  
  function products() {
    $results = array();
    $results['pageTitle'] = "Products | Ecommerce";
    require(TEMPLATE_PATH . "/products.php");
  }
  
  function register() {
    $results = array();
    $results['pageTitle'] = "Register | Ecommerce";
    require(TEMPLATE_PATH . "/register.php");
  }
  
  function single() {
    $results = array();
    $results['pageTitle'] = "Single | Ecommerce";
    require(TEMPLATE_PATH . "/single.php");
  }

function home() {
    $results = array();
    $data = Article::getList(HOMEPAGE_NUM_ARTICLES);
    $results['articles'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Ecommerce";
    require(TEMPLATE_PATH . "/home.php");
  }

?>

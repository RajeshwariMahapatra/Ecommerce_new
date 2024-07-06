<?php
require("config.php");

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
    case "viewCategoryProducts":
        viewCategoryProducts();
        break;
    case "listPages":
        listPages();
        break;
    case "viewPages":
        viewPages();
        break;
    default:
        homepage();
        break;
}

function userRegister()
{
}
function userLogin()
{
}
function userLogout()
{
}
function viewProducts()
{

    $results = array();


    if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
        $categoryId = intval($_GET['category_id']);
        $products = Product::getByCategoryId($categoryId);
        $results['products'] = $products;
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

    $data = Product::getList();
    $results["products"] = $data['results'];
    $results["totalRows"] = $data['totalRows'];
    $results["pageTitle"] = 'Products List';

    // echo "<pre>";
    // var_dump($results);
    require(TEMPLATE_PATH_web . "/single.php");
}

function viewCategoryProducts()
{

    $_GET = [
        "category_id" => 2,
    ];

    $results = array();
    $results['products'] = Product::getByCategoryId($_GET['category_id']);
    // $results["pageTitle"]='Products List';
    echo "<pre>";
    var_dump($results);

    if (empty($results['products'])) {
        echo "<p>No products found in this category.</p>";
    }
}

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

<?php
// require("config.php");
require("functions.php");

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
    default:
        homepage();
        break;
}

function userRegister()
{

    $results = array();
    $results['pageTitle'] = "Add Users";
    $results['formAction'] = "addUsers";
    if(isset($_POST["saveChanges"])){

        $_POST['user_identity'] = uniqueRandomString(12, 'Users', 'user_identity');
        $_POST['user_password'] = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
        $user = new Users;
        $user->storeFormValues($_POST);
        $user->insert();
        header("Location: users.php?action=userRegister&status=changesSaved");

    }
    elseif (isset($_POST['cancel'])) {

        header("Location: users.php?action=userRegister");
    } 
    else {

    $results['user'] = new Users;
    $results['states'] = State::getList()['results'];
    $results['countries'] = Country::getList()['results'];
    require(TEMPLATE_PATH_web . "/account.php");
    }
}
function userLogin()
{
    require(TEMPLATE_PATH_web . "/login.php");
}
function userLogout()
{
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

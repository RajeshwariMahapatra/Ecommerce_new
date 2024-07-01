<?php
require("config.php");
require("functions.php");
session_start();
$action = isset($_GET['action']) ? $_GET['action'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

if ($action != "login" && $action != "logout" && !$username) {
    login();
    exit;
}
switch ($action) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    case 'addProduct':
        addProduct();
        break;
    case 'editProduct':
        editProduct();
        break;
    case 'deleteProduct':
        deleteProduct();
    case 'addProductcategory':
        addProductcategory();
        break;
    case 'editProductCategory':
        editProductCategory();
        break;
    case 'deleteProductCategory':
        deleteProductCategory();
    case 'addBrand':
        addBrand();
        break;
    case 'editBrand':
        editBrand();
        break;
    case 'deleteBrand':
        deleteBrand();
        break;
    

    default:
        showDashboard();
}

function login()
{
    $results = array();
    $results['pageTitle'] = "Admin Login";

    if (isset($_POST['login'])) {


        if ($_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD) {

            $_SESSION['username'] = ADMIN_USERNAME;
            header("Location: admin.php");
        } else {
            
            header("Location: admin.php?action=login");
            $results['errorMessage'] = "Incorrect username or password. Please try again.";
        }
    } else {

        require(TEMPLATE_PATH . "/admin/login.php");
    }
}

function logout()
{
    unset($_SESSION['username']);
    header("Location: admin.php");
}

function addProduct(){  
    
    $result = array();
    $results['pageTitle'] = "Add Product";
    $results['formAction'] = "addProduct";


    if (isset($_POST["saveChanges"])) {

        $_POST['product_identity'] = uniqueRandomString(12, 'Product', 'product_identity');


        $productdata = $_POST;
        $product = new Product;
        $product->storeFormValues($productdata);

        $product->insert();
        // echo '<pre>';
        // var_dump($product);
        header('Location: admin.php?status=changesSaved');

    } 
    elseif (isset($_POST['cancel'])) {

        // echo "cancelled successfully";
        header("Location: admin.php");
    } else {
        $results['product'] = new Product;
        $results['pageTitle'] = "Add New Product";
        $results['formAction'] = "addProduct";
        $results['categories'] = ProductCategory::getList()['results'];
        $results['brands'] = Brand::getList()['results'];
        require(TEMPLATE_PATH . "/admin/add_product.php");
        // var_dump($results);
        // echo "error";
    }
}

function editProduct()  {

    $result = array();
    $results['pageTitle'] = "Edit Product";
    $results['formAction'] = "editProduct";

    if (isset($_POST['saveChanges'])) {
    
        if (!$product = Product::getById((int)$_POST['product_id'])) {
            header("Location: admin.php?error=productNotFound");
            return;
        }
        $productdata = $_POST;
        $product->storeFormValues($productdata);

        $product->update();
        // echo "<pre>";
        // var_dump($product);
        header("Location: admin.php?status=changesSaved");
    } elseif (isset($_POST['cancel'])) {

        // Admin has cancelled their edits: return to the products list
        header("Location: admin.php");
    } else {
        $results['product'] = Product::getById((int)$_GET['product_id']);
        require(TEMPLATE_PATH . "/admin/add_product.php");
    }
}

function deleteProduct() {

    if (!$product = Product::getById((int)$_GET['product_id'])) {
        header("Location: admin.php?error=productNotFound");
        return;
    }
    
    $product->delete();
    header("Location: admin.php?status=productDeleted");
}


?>
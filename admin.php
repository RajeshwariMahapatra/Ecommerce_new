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
    case 'listProducts':
        listProducts();
        break;
    case 'listProducts2':
        listProducts2();
        break;
    case 'editProduct':
        editProduct();
        break;
    case 'deleteProduct':
        deleteProduct();
    case 'addProductCategory':
        addProductCategory();
        break;
    case 'listCategories':
        listCategories();
        break;
    case 'editProductCategory':
        editProductCategory();
        break;
    case 'deleteProductCategory':
        deleteProductCategory();
    case 'addBrand':
        addBrand();
        break;
    case 'listBrands':
        listBrands();
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

function addProduct()
{
    // Initialize results array
    $results = array();
    $results['pageTitle'] = "Add Product";
    $results['formAction'] = "addProduct";

    // Check if the form has been submitted
    if (isset($_POST["saveChanges"])) {
        // Collect the form data
        $_POST['product_identity'] = uniqueRandomString(12, 'Product', 'product_identity');
        $productdata = $_POST;
        $product = new Product();
        $product->storeFormValues($productdata);

        // Insert the new product into the database
        $product->insert();

        // Check if image files are uploaded and store them
        if (isset($_FILES['product_product_image_1']) || isset($_FILES['product_product_image_2']) || isset($_FILES['product_product_image_3'])) {
            $product->storeUploadedImages($_FILES);
        }

        // Redirect to the admin page with a status message
        header('Location: admin.php?action=listProducts&status=changesSaved');
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the admin page if the form was cancelled
        header("Location: admin.php?action=listProducts");
    } else {
        // Prepare data for displaying the form
        $results['product'] = new Product();
        $results['categories'] = ProductCategory::getList()['results'];
        $results['brands'] = Brand::getList()['results'];
        require(TEMPLATE_PATH . "/admin/addProduct.php");
    }
}
function listProducts()
{
    $results = array();
    $data = Product::getList();
    $results['products'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Products";

    if (isset($_GET['error'])) {
        if ($_GET['error'] == "productNotFound") $results['errorMessage'] = "Error: Product not found.";
    }

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "changesSaved") $results['statusMessage'] = "Your changes have been saved.";
        if ($_GET['status'] == "productDeleted") $results['statusMessage'] = "Product deleted.";
    }

    // echo "<pre>";
    // var_dump($results);
    require(TEMPLATE_PATH . "/admin/view_products.php");
    // require(TEMPLATE_PATH . "/admin/view_product.php");
}

function listProducts2()
{
    $results = array();
    if (!isset($_GET['product_id'])) {
        header("Location: admin.php?error=productNotFound");
        return;
    }
    $productId = (int)$_GET['product_id']; // Assuming product_id is passed in GET data

    // Get the product details
    $product = Product::getById($productId);
    if (!$product) {
        header("Location: admin.php?error=productNotFound");
        return;
    }

    // Get category name
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT category_name FROM ProductCategory WHERE category_id = :category_id";
    $st = $conn->prepare($sql);
    $st->bindValue(":category_id", $product->product_category_id, PDO::PARAM_INT);
    $st->execute();
    $product->category_name = $st->fetchColumn();

    // Get brand name


    $sql = "SELECT brand_name FROM Brand WHERE brand_id = :brand_id";
    $st = $conn->prepare($sql);
    $st->bindValue(":brand_id", $product->product_brand_id, PDO::PARAM_INT);
    $st->execute();
    $product->brand_name = $st->fetchColumn();

    $conn = null;

    $results['product'] = $product;
    require(TEMPLATE_PATH . "/admin/productDetails.php");
}

function editProduct()
{
    $results = array();
    $results['pageTitle'] = "Edit Product";
    $results['formAction'] = "editProduct";

    if (isset($_POST['saveChanges'])) {
        if (!$product = Product::getById((int)$_POST['product_id'])) {
            header("Location: admin.php?error=productNotFound");
            return;
        }
        $productdata = $_POST;
        $product->storeFormValues($productdata);

        // Check for delete image requests
        for ($i = 1; $i <= 3; $i++) {
            if (isset($_POST["deleteImage$i"]) && $_POST["deleteImage$i"] == "yes") {
                $product->deleteImage($i);
            }
        }

        // Handle file uploads
        if (isset($_FILES)) {
            $product->storeUploadedImages($_FILES);
        }

        $product->update();
        header("Location: admin.php?action=listProducts&status=changesSaved");
    } elseif (isset($_POST['cancel'])) {
        header("Location: admin.php?action=listProducts");
    } else {
        $results['product'] = Product::getById((int)$_GET['product_id']);
        $results['categories'] = ProductCategory::getList()['results'];
        $results['brands'] = Brand::getList()['results'];
        require(TEMPLATE_PATH . "/admin/addProduct.php");
    }
}

function deleteProduct()
{

    if (!$product = Product::getById((int)$_GET['product_id'])) {
        header("Location: admin.php?error=productNotFound");
        return;
    }

    $product->deleteImages();
    $product->delete();
    header("Location: admin.php?status=productDeleted");
}

function addProductCategory()
{
    // Initialize results array
    $results = array();
    $results['pageTitle'] = "Add Category";
    $results['formAction'] = "addProductCategory";

    // Check if the form has been submitted
    if (isset($_POST["saveChanges"])) {
        // Collect the form data
        $categoryData = $_POST;
        $category = new ProductCategory;
        $category->storeFormValues($categoryData);

        // Insert the new category into the database
        $category->insert();

        // Redirect to the admin page with a status message
        header('Location: admin.php?status=categoryAdded');
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the admin page if the form was cancelled
        header("Location: admin.php");
    } else {
        // Prepare data for displaying the form
        $results['category'] = new ProductCategory;
        // $results['pageTitle'] = "Add New Category";
        // $results['formAction'] = "addProductCategory";
        require(TEMPLATE_PATH . "/admin/addCategory.php");
    }
}

function editProductCategory()
{
    // Initialize results array
    $results = array();
    $results['pageTitle'] = "Edit Category";
    $results['formAction'] = "editProductCategory";

    if (isset($_POST['saveChanges'])) {
        // Check if category ID is provided
        if (!isset($_POST['category_id'])) {
            header("Location: admin.php?error=categoryIdMissing");
            return;
        }

        // Retrieve the category from the database
        if (!$category = ProductCategory::getById((int)$_POST['category_id'])) {
            header("Location: admin.php?error=categoryNotFound");
            return;
        }

        // Collect the form data
        $categoryData = $_POST;
        $category->storeFormValues($categoryData);

        // Update the category in the database
        $category->update();

        // Redirect to the admin page with a status message
        header("Location: admin.php?action=listCategories&status=categoryUpdated");
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the admin page if the edit was cancelled
        header("Location: admin.php?action=listCategories");
    } else {
        // Retrieve the category details for editing
        $results['category'] = ProductCategory::getById((int)$_GET['category_id']);
        require(TEMPLATE_PATH . "/admin/addCategory.php");
    }
}

function deleteProductCategory()
{
    // Retrieve the category from the database
    if (!$category = ProductCategory::getById((int)$_GET['category_id'])) {
        header("Location: admin.php?error=categoryNotFound");
        return;
    }

    // Delete the category from the database
    $category->delete();

    // Redirect to the admin page with a status message
    header("Location: admin.php?action=listCategories&status=categoryDeleted");
}

function listCategories()
{
    // Initialize results array
    $results = array();
    $results['pageTitle'] = "View Categories";

    // Fetch categories from database (assuming ProductCategory is your model)
    $data = ProductCategory::getList();

    if (isset($_GET['error'])) {
        if ($_GET['error'] == "categoryNotFound") $results['errorMessage'] = "Error: category not found.";
    }

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "changesSaved") $results['statusMessage'] = "Your changes have been saved.";
        if ($_GET['status'] == "categoryDeleted") $results['statusMessage'] = "category deleted.";
    }
    // Pass categories to the template
    $results['categories'] = $data['results'];

    // Load the template
    require(TEMPLATE_PATH . "/admin/view_categories.php");
}


function addBrand()
{
    // Initialize results array
    $results = array();
    $results['pageTitle'] = "Add Brand";
    $results['formAction'] = "addBrand";

    // Check if the form has been submitted
    if (isset($_POST["saveChanges"])) {
        // Collect the form data
        $brandData = $_POST;
        $brand = new Brand;
        $brand->storeFormValues($brandData);

        // Insert the new brand into the database
        $brand->insert();

        // Redirect to the admin page with a status message
        header('Location: admin.php?status=brandAdded');
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the admin page if the form was cancelled
        header("Location: admin.php");
    } else {
        // Prepare data for displaying the form
        $results['brand'] = new Brand;
        $results['pageTitle'] = "Add New Brand";
        $results['formAction'] = "addBrand";
        require(TEMPLATE_PATH . "/admin/addBrand.php");
    }
}


function editBrand()
{
    // Initialize results array
    $results = array();
    $results['pageTitle'] = "Edit Brand";
    $results['formAction'] = "editBrand";

    if (isset($_POST['saveChanges'])) {
        // Check if brand ID is provided
        if (!isset($_POST['brand_id'])) {
            header("Location: admin.php?error=brandIdMissing");
            return;
        }

        // Retrieve the brand from the database
        if (!$brand = Brand::getById((int)$_POST['brand_id'])) {
            header("Location: admin.php?error=brandNotFound");
            return;
        }

        // Collect the form data
        $brandData = $_POST;
        $brand->storeFormValues($brandData);

        // Update the brand in the database
        $brand->update();

        // Redirect to the admin page with a status message
        header("Location: admin.php?action=listBrands&status=brandUpdated");
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the admin page if the edit was cancelled
        header("Location: admin.php?action=listBrands");
    } else {
        // Retrieve the brand details for editing
        $results['brand'] = Brand::getById((int)$_GET['brand_id']);
        require(TEMPLATE_PATH . "/admin/addBrand.php");
    }
}


function deleteBrand()
{
    // Retrieve the brand from the database
    if (!$brand = Brand::getById((int)$_GET['brand_id'])) {
        header("Location: admin.php?error=brandNotFound");
        return;
    }

    // Delete the brand from the database
    $brand->delete();

    // Redirect to the admin page with a status message
    header("Location: admin.php?status=brandDeleted");
}

function listBrands()
{
    $results = array();
    $data = Brand::getList();
    $results['brands'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Brands";

    if (isset($_GET['error'])) {
        if ($_GET['error'] == "brandNotFound") $results['errorMessage'] = "Error: brand not found.";
    }

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "changesSaved") $results['statusMessage'] = "Your changes have been saved.";
        if ($_GET['status'] == "brandDeleted") $results['statusMessage'] = "Brand deleted.";
    }

    
    require(TEMPLATE_PATH . "/admin/view_brand.php");
}



function showDashboard()
{
    $results = array();
    $results['pageTitle'] = "Admin Dashboard";

    // Assuming you have a method to get admin details and counts of other entities
    // $results['admin'] = getAdminDetails();

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "loggedOut") $results['statusMessage'] = "You have been logged out.";
    }

    require(TEMPLATE_PATH . "/admin/index.php");
}

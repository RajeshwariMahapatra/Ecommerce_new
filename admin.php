<?php
// require("config.php");
require("functions.php");
require('validations.php');
require('errors.php');
session_name('admin_session'); // For admin section
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
    case 'addState':
        addState();
        break;
    case 'editState':
        editState();
        break;
    case 'deleteState':
        deleteState();
        break;
    case 'listStates':
        listStates();
        break;
    case 'addCountry':
        addCountry();
        break;
    case 'editCountry':
        editCountry();
        break;
    case 'deleteCountry':
        deleteCountry();
        break;
    case 'listCountries':
        listCountries();
        break;
    case 'listDiscounts':
        listDiscounts();
        break;
    case 'listDiscounts2':
        listDiscounts2();
        break;
    case 'addDiscount':
        addDiscount();
        break;
    case 'editDiscount':
        editDiscount();
        break;
    case 'deleteDiscount':
        deleteDiscount();
        break;
    case 'addUsers':
        addUsers();
        break;
    case 'editUsers':
        editUsers();
        break;
    case 'deleteUser':
        deleteUser();
        break;
    case 'listUsers':
        listUsers();
        break;
    case 'listUsers2':
        listUsers2();
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
    case 'addPage':
        addPage();
        break;
    case 'editPage':
        editPage();
        break;
    case 'listPage':
        listPage();
        break;
    case 'listPage2':
        listPage2();
        break;
    case 'deletePage':
        deletePage();
        break;
    case 'listOrders':
        listOrders();
        break;
    case 'listOrders2':
        listOrders2();
        break;
    case 'editOrder':
        editOrder();
        break;
    case 'deleteOrder':
        deleteOrder();
        break;
    default:
        showDashboard();
}


function login(){
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

function logout(){
    unset($_SESSION['username']);
    header("Location: admin.php");
}

function addUsers(){

    $results = array();
    $results['pageTitle'] = "Add Users";
    $results['formAction'] = "addUsers";

    if (isset($_POST["saveChanges"])) {

        $_POST['user_identity'] = uniqueRandomString(12, 'Users', 'user_identity');

        $user = new Users;
        $user->storeFormValues($_POST);
        $user->insert();
        header("Location: admin.php?action=listUsers&status=changesSaved");
    } elseif (isset($_POST['cancel'])) {

        header("Location: admin.php?action=listUsers");
    } else {
        $results['user'] = new Users;
        $results['states'] = State::getList()['results'];
        $results['countries'] = Country::getList()['results'];
        require(TEMPLATE_PATH . "/admin/addUsers.php");
    }
}

function editUsers(){
    $results = array();
    $results['pageTitle'] = "Edit Users";
    $results["formAction"] = "editUsers";

    if (isset($_POST["saveChanges"])) {
        $_POST['user_identity'] = uniqueRandomString(12, 'Users', 'user_identity');

        // Check if category ID is provided
        if (!isset($_POST['user_id'])) {
            header("Location: admin.php?error=userIdMissing");
            return;
        }

        // Retrieve the category from the database
        if (!$user = Users::getById((int)$_POST['user_id'])) {
            header("Location: admin.php?error=userNotFound");
            return;
        }

        // Collect the form data
        $userData = $_POST;
        $user->storeFormValues($userData);

        // Update the category in the database
        $user->update();

        // Redirect to the admin page with a status message
        header("Location: admin.php?action=listUsers&status=changesSaved");
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the admin page if the edit was cancelled
        header("Location: admin.php?action=listUsers");
    } else {
        // Retrieve the category details for editing
        $results['user'] = Users::getById((int)$_GET['user_id']);
        $results['states'] = State::getList()['results'];
        $results['countries'] = Country::getList()['results'];
        require(TEMPLATE_PATH . "/admin/addUsers.php");
    }
}
function listUsers(){

    $results = array();
    $data = Users::getList();
    $results['users'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Users";

    if (isset($_GET['error'])) {
        if ($_GET['error'] == "userNotFound") $results['errorMessage'] = "Error: User not found.";
    }

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "changesSaved") $results['statusMessage'] = "Your changes have been saved.";
        if ($_GET['status'] == "userDeleted") $results['statusMessage'] = "User deleted.";
    }

    require(TEMPLATE_PATH . "/admin/view_users.php");
}

function listUsers2(){
    $results = array();
    if (!$user = Users::getById((int)$_GET['user_id'])) {
        header("Location: admin.php?error=userNotFound");
        return;
    }

    $results['user'] = $user;

    // Fetch state name
    $state = Users::getStateById($user->user_address_state_id);
    $results['user_state'] = $state ? $state->state_name : 'Unknown';

    // Fetch country name
    $country = Users::getCountryById($user->user_address_country_id);
    $results['user_country'] = $country ? $country->country_name : 'Unknown';

    require(TEMPLATE_PATH . "/admin/userDetails.php");
}

function deleteUser(){

    if (!$user = Users::getById((int)$_GET['user_id'])) {
        header("Location: admin.php?action=listUserss&error=usertNotFound");
        return;
    }
    $user->delete();
    header("Location: admin.php?action=listUsers&status=userDeleted");
}

function addState(){
    
    $results = array();
    $results['pageTitle'] = 'New State';
    $results['formAction'] = 'addState';
    
    
    if (isset($_POST['saveChanges'])) {
        
        $_POST['state_identity'] = uniqueRandomString(12, 'State', 'state_identity');
        $state = new State;
        $state->storeFormValues($_POST);
        $state->insert();

        header("Location: admin.php?action=listStates&status=changesSaved");
    } elseif (isset($_POST["cancel"])) {
        header("Location: admin.php?action=listStates");
    } else {
        $results['state'] = new State;
        require(TEMPLATE_PATH . "/admin/addState.php");
    }
}

function editState(){
    $results = array();
    $results['pageTitle'] = 'Edit State';
    $results['formAction'] = 'editState';

    if (isset($_POST['saveChanges'])) {

        if (!$state = State::getById((int)$_POST['state_id'])) {
            header("Location: admin.php?error=stateNotFound");
            return;
        }

        $state->storeFormValues($_POST);
        $state->update();

        // echo "<pre>";
        // var_dump($state);
        header("Location: admin.php?action=listStates&status=changesSaved");

    } elseif (isset($_POST["cancel"])) {
        header("Location: admin.php?action=listStates");
    } else {
        $results['state'] = State::getById((int)($_GET['state_id']));
        require(TEMPLATE_PATH . "/admin/addState.php");
    }
}

function listStates(){

    $results = array();
    $results['pageTitle'] = "View States";
    // Fetch categories from database (assuming ProductCategory is your model)
    $data = State::getList();
    $results['states'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];



    if (isset($_GET['error'])) {
        if ($_GET['error'] == "statesNotFound") $results['errorMessage'] = "Error: states not found.";
    }

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "changesSaved") $results['statusMessage'] = "Your changes have been saved.";
        if ($_GET['status'] == "statesDeleted") $results['statusMessage'] = "states deleted.";
    }
    // Pass categories to the template
    $results['states'] = $data['results'];

    // Load the template
    require(TEMPLATE_PATH . "/admin/view_states.php");
}

function deleteState(){
    // Retrieve the category from the database
    if (!$state = State::getById((int)$_GET['state_id'])) {
        header("Location: admin.php?error=stateNotFound");
        return;
    }

    // Delete the category from the database
    $state->delete();

    // Redirect to the admin page with a status message
    header("Location: admin.php?action=listStates&status=stateDeleted");
}
function addCountry(){
    
    $results = array();
    $results['pageTitle'] = 'New Country';
    $results['formAction'] = 'addCountry';
    
    
    if (isset($_POST['saveChanges'])) {
        
        $_POST['country_identity'] = uniqueRandomString(12, 'Country', 'country_identity');
        $country = new Country;
        $country->storeFormValues($_POST);
        $country->insert();

        header("Location: admin.php?action=listCountries&status=changesSaved");
    } elseif (isset($_POST["cancel"])) {
        header("Location: admin.php?action=listCountries");
    } else {
        $results['country'] = new Country;
        require(TEMPLATE_PATH . "/admin/addCountry.php");
    }
}

function editCountry(){
    
    $results = array();
    $results['pageTitle'] = 'Edit Country';
    $results['formAction'] = 'editCountry';

    if (isset($_POST['saveChanges'])) {

        if (!$country = Country::getById((int)$_POST['country_id'])) {
            header("Location: admin.php?error=countryNotFound");
            return;
        }

        $country->storeFormValues($_POST);
        $country->update();

        // echo "<pre>";
        // var_dump($state);
        header("Location: admin.php?action=listCountries&status=changesSaved");

    } elseif (isset($_POST["cancel"])) {
        header("Location: admin.php?action=listCountries");
    } else {
        $results['country'] = Country::getById((int)($_GET['country_id']));
        require(TEMPLATE_PATH . "/admin/addCountry.php");
    }
}

function listCountries(){

    $results = array();
    $results['pageTitle'] = "View Countries";
    // Fetch categories from database (assuming ProductCategory is your model)
    $data = Country::getList();
    $results['countries'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];



    if (isset($_GET['error'])) {
        if ($_GET['error'] == "countriesNotFound") $results['errorMessage'] = "Error: Countries not found.";
    }

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "changesSaved") $results['statusMessage'] = "Your changes have been saved.";
        if ($_GET['status'] == "countriesDeleted") $results['statusMessage'] = "Countries deleted.";
    }
    // Pass categories to the template
    $results['countries'] = $data['results'];

    // Load the template
    require(TEMPLATE_PATH . "/admin/view_countries.php");
}

function deleteCountry(){
    // Retrieve the category from the database
    if (!$country = Country::getById((int)$_GET['country_id'])) {
        header("Location: admin.php?error=countryNotFound");
        return;
    }

    // Delete the category from the database
    $country->delete();

    // Redirect to the admin page with a status message
    header("Location: admin.php?action=listCountries&status=countryDeleted");
}

function addProduct(){
    // Initialize results array'i


    $results = array();
    $results['pageTitle'] = "Add Product";
    $results['formAction'] = "addProduct";

    // Check if the form has been submitted
    if (isset($_POST["saveChanges"])) {
        // Validate the form data
        $errors = validateProduct($_POST);
        $errorcode = validateProduct($_POST);
        if ($errorcode != 200) {
            $errorstatus = checkerror($errorcode);
            $results['product'] = new Product($_POST); // Pass the submitted data back to the form
            $results['categories'] = ProductCategory::getList()['results'];
            $results['brands'] = Brand::getList()['results'];
            require(TEMPLATE_PATH . "/admin/addProduct.php");
            exit();
        } else {

            foreach (['product_desc', 'product_small_desc'] as $field) {
                if (!empty($_POST[$field])) {
                    $_POST[$field] = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
                }
            }

            $results['product'] = new Product($_POST); // Pass the submitted data back to the form
            $results['categories'] = ProductCategory::getList()['results'];
            $results['brands'] = Brand::getList()['results'];
        }

        // if (!empty($errors)) {
        //     // If there are validation errors, show the form again with errors
        //     $results['errors'] = $errors;

        //     require(TEMPLATE_PATH . "/admin/addProduct.php");
        //     return;
        // }

        // Collect the form data
        $_POST['product_identity'] = uniqueRandomString(12, 'Product', 'product_identity');
        $productdata = $_POST;
        $product = new Product();
        $product->storeFormValues($productdata);
        // var_dump($product);
        // die();
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

function listProducts(){
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

function listProducts2(){
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

function editProduct(){
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

function deleteProduct(){

    if (!$product = Product::getById((int)$_GET['product_id'])) {
        header("Location: admin.php?action=listProducts&error=productNotFound");
        return;
    }

    $product->deleteImages();
    $product->delete();
    header("Location: admin.php?action=listProducts&status=productDeleted");
}

function addProductCategory(){
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
        $_POST['category_identity'] = uniqueRandomString(12, 'ProductCategory', 'category_identity');

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
    $results['categories'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];



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
        $_POST['brand_identity'] = uniqueRandomString(12, 'Brand', 'brand_identity');

        $brandData = $_POST;
        $brand = new Brand;
        $brand->storeFormValues($brandData);

        // Insert the new brand into the database
        $brand->insert();

        // Redirect to the admin page with a status message
        header('Location: admin.php?status=brandAdded');
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the admin page if the form was cancelled
        header("Location: admin.php?action=listBrands");
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
        header("Location: admin.php?action=listBrands&status=changesSaved");
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
    header("Location: admin.php?action=listBrands&status=brandDeleted");
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

function addPage()
{
    $results = array();
    $results['pageTitle'] = "Add Page";
    $results['formAction'] = "addPage";

    // Check if the form has been submitted
    if (isset($_POST["saveChanges"])) {
        $_POST['page_identity'] = uniqueRandomString(12, 'Pages', 'page_identity');

        // Collect the form data
        $pageData = $_POST;
        $page = new Pages;
        $page->storeFormValues($pageData);

        // Handle the cover image upload
        if (isset($_FILES['page_coverimage']) && $_FILES['page_coverimage']['error'] === UPLOAD_ERR_OK) {
            $page->storeUploadedCoverImage($_FILES['page_coverimage']);
        }


        // Insert the new brand into the database
        $page->insert();

        // Redirect to the admin page with a status message
        header('Location: admin.php?action=listPage&status=pageAdded');
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the admin page if the form was cancelled
        header("Location: admin.php?action=listPage");
    } else {
        // Prepare data for displaying the form
        $results['page'] = new Pages;
        $results['pageTitle'] = "Add New Page";
        $results['formAction'] = "addPage";
        require(TEMPLATE_PATH . "/admin/addPage.php");
    }
}

function listPage()
{
    $results = array();
    $data = Pages::getList();
    $results['pages'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Pages";

    if (isset($_GET['error'])) {
        if ($_GET['error'] == "pageNotFound") $results['errorMessage'] = "Error: Page not found.";
    }

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "changesSaved") $results['statusMessage'] = "Your changes have been saved.";
        if ($_GET['status'] == "pageDeleted") $results['statusMessage'] = "Page deleted.";
    }

    require(TEMPLATE_PATH . "/admin/view_page.php");
}

function listPage2()
{
    $results = array();
    if (!isset($_GET['page_id'])) {
        header("Location: admin.php?error=page]NotFound");
        return;
    }
    $pageId = (int)$_GET['page_id']; // Assuming product_id is passed in GET data

    // Get the product details
    $page = Pages::getById($pageId);
    if (!$page) {
        header("Location: admin.php?error=pageNotFound");
        return;
    }

    $results['page'] = $page;
    require(TEMPLATE_PATH . "/admin/pageDetails.php");
}
function editPage()
{
    $results = array();
    $results['pageTitle'] = "Edit Page";
    $results['formAction'] = "editPage";

    if (isset($_POST['saveChanges'])) {
        if (!$page = Pages::getById((int)$_POST['page_id'])) {
            header("Location: admin.php?error=pageNotFound");
            return;
        }
        $pagedata = $_POST;
        $page->storeFormValues($pagedata);

        if (isset($_FILES['page_coverimage']) && $_FILES['page_coverimage']['error'] == UPLOAD_ERR_OK) {
            $page->storeUploadedCoverImage($_FILES['page_coverimage']);
        }


        $page->update();

        header("Location: admin.php?action=listPage&status=changesSaved");
    } elseif (isset($_POST['cancel'])) {
        header("Location: admin.php?action=listPage");
    } else {
        $results['page'] = Pages::getById((int)$_GET['page_id']);
        require(TEMPLATE_PATH . "/admin/addPage.php");
    }
}

function deletePage()
{
    // Retrieve the page from the database
    if (!$page = Pages::getById((int)$_GET['page_id'])) {
        header("Location: admin.php?error=pageNotFound");
        return;
    }

    // Delete the page from the database
    $page->delete();

    // Redirect to the listpage page with a status message
    header("Location: admin.php?action=listPage&status=pageDeleted");
}
function listDiscounts() {
    $results = array();
    $discounts = Discounts::getList();
    $results['discounts'] = $discounts['results'];
    $results['totaldiscountRows'] = $discounts['totalRows'];
    $results['pageTitle'] = "All Discounts";
    require(TEMPLATE_PATH . "/admin/listDiscounts.php");
}

function listDiscounts2() {

    $results = array();
    if (!isset($_GET['discount_id'])) {
        header("Location: admin.php?error=pageNotFound");
        return;
    }
    $discountId = (int)$_GET['discount_id']; // Assuming product_id is passed in GET data

    // Get the product details
    $discount = Discounts::getById($discountId);
    if (!$discount) {
        header("Location: admin.php?error=discountIDNotFound");
        return;
    }

    $results['discount'] = $discount;
    require(TEMPLATE_PATH . "/admin/discountDetails.php");

}

// Function to add a new discount
function addDiscount() {
    $results = array();
    $results['pageTitle'] = 'New Discount';
    $results['formAction'] = 'addDiscount';
    if (isset($_POST['saveChanges'])) {
        $_POST['state_identity'] = uniqueRandomString(12, 'Discounts', 'discount_identity');
        $discounts = new Discounts;
        $discounts->storeFormValues($_POST);
        $discounts->insert();

        header("Location: admin.php?action=listDiscounts&status=changesSaved");
    } elseif (isset($_POST["cancel"])) {
        header("Location: admin.php?action=listDiscounts");
    } else {
        $results['discounts'] = new Discounts;
        require(TEMPLATE_PATH . "/admin/addDiscount.php");
    }
}

// Function to edit an existing discount
function editDiscount() {
    $results = array();
    $results['pageTitle'] = 'Edit Discount';
    $results['formAction'] = 'editDiscount';

    if (isset($_POST['saveChanges'])) {

        if (!$discounts = Discounts::getById((int)$_POST['discount_id'])) {
            header("Location: admin.php?error=discountNotFound");
            return;
        }

        $discounts->storeFormValues($_POST);
        $discounts->update();

        header("Location: admin.php?action=listDiscounts&status=changesSaved");

    } elseif (isset($_POST["cancel"])) {
        header("Location: admin.php?action=listDiscounts");
    } else {
        $results['discounts'] = Discounts::getById((int)($_GET['discount_id']));
        require(TEMPLATE_PATH . "/admin/addDiscount.php");
    }
}

// Function to delete an existing discount
function deleteDiscount() {
    if (!$discounts = Discounts::getById((int)$_GET['discount_id'])) {
        header("Location: admin.php?error=discountNotFound");
        return;
    }

    // Delete the category from the database
    $discounts->delete();

    // Redirect to the admin page with a status message
    header("Location: admin.php?action=listDiscounts&status=discountDeleted");
}

function listOrders2() {
    $results = array();
    if (!isset($_GET['order_id'])) {
        header("Location: admin.php?error=orderNotFound");
        return;
    }
    $orderId = (int)$_GET['order_id'];

    // Get the order details
    $order = Orders::getById($orderId);
    if (!$order) {
        header("Location: admin.php?error=orderNotFound");
        return;
    }

    // Get user details
    $user = Users::getById($order->user_id);
    $order->user_name = $user->user_name;
    $order->user_email = $user->user_email;

    // Get state name
    $state = State::getById($order->delivery_state_id);
    $order->state_name = $state ? $state->state_name : null;

    // Get country name
    $country = Country::getById($order->delivery_country_id);
    $order->country_name = $country ? $country->country_name : null;

    // Get order items
    $orderItems = OrderItems::getByOrderId($orderId);
    $order->items = $orderItems;

    $results['order'] = $order;
    require(TEMPLATE_PATH . "/admin/orderDetails.php");
}

function listOrders() {
    $results = array();
    $data = Orders::getAllOrders();  // Assuming you have a method in Orders class to get all orders
    $results['orders'] = $data['orders'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Orders";

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "success") {
            $results['statusMessage'] = "Order updated successfully.";
        } else if ($_GET['status'] == "deleted") {
            $results['statusMessage'] = "Order deleted successfully.";
        }
    }

    require(TEMPLATE_PATH . "/admin/listOrders.php");
}

function editOrder() {
    $results = array();
    $results['pageTitle'] = "Edit Order Status";
    $results['formAction'] = "editOrder";

    if (isset($_POST['saveChanges'])) {
        if (!$order = Orders::getById((int)$_POST['order_id'])) {
            header("Location: admin.php?error=orderNotFound");
            return;
        }

        $orderData = array(
            'order_id' => (int)$_POST['order_id'],
            'order_status' => $_POST['order_status']
        );

        $order->storeFormValues($orderData);
        $order->update();

        header("Location: admin.php?action=listOrders&status=changesSaved");
    } elseif (isset($_POST['cancel'])) {
        header("Location: admin.php?action=listOrders");
    } else {
        $results['order'] = Orders::getById((int)$_GET['order_id']);
        require(TEMPLATE_PATH . "/admin/editOrder.php");
    }
}

function deleteOrder() {
    // Validate the order ID from the GET parameter
    $order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

    // Check if the order ID is valid and the order exists
    if ($order_id <= 0 || !$order = Orders::getById($order_id)) {
        header("Location: admin.php?error=orderNotFound");
        exit;
    }

    try {
        // Start a transaction
        Orders::beginTransaction();

        // Delete associated order items
        OrderItems::deleteByOrderId($order_id);

        // Delete the order from the database
        $order->delete();

        // Commit the transaction
        Orders::commit();

        // Redirect to the admin page with a success message
        header("Location: admin.php?action=listOrders&status=orderDeleted");
        exit;
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        Orders::rollback();

        // Handle potential exceptions and redirect with an error message
        header("Location: admin.php?error=orderDeletionFailed&message=" . urlencode($e->getMessage()));
        exit;
    }
}

function showDashboard(){
    $results = array();
    $results['pageTitle'] = "Admin Dashboard";

    // Assuming you have a method to get admin details and counts of other entities
    // $results['admin'] = getAdminDetails();

    if (isset($_GET['status'])) {
        if ($_GET['status'] == "loggedOut") $results['statusMessage'] = "You have been logged out.";
    }

    require(TEMPLATE_PATH . "/admin/index.php");
}

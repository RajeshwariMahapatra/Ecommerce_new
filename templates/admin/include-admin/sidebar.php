<?php
function getCurrentPage()
{
    if (isset($_GET['action'])) {
        return $_GET['action'];
    }
    return 'dashboard';
}

$current_page = getCurrentPage();
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">WP Admin </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $current_page == 'dashboard' ? 'active' : ''; ?>">
        <a class="nav-link" href="admin.php?action=dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo in_array($current_page, ['addProduct', 'listProducts']) ? 'active' : ''; ?>">
        <a class="nav-link <?php echo in_array($current_page, ['addProduct', 'listProducts']) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Products</span>
        </a>
        <div id="collapseTwo" class="collapse <?php echo in_array($current_page, ['addProduct', 'listProducts']) ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Products:</h6>
                <a class="collapse-item <?php echo $current_page == 'addProduct' ? 'active' : ''; ?>" href="admin.php?action=addProduct">Add Product</a>
                <a class="collapse-item <?php echo $current_page == 'listProducts' ? 'active' : ''; ?>" href="admin.php?action=listProducts">View Products</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo in_array($current_page, ['addUsers', 'listUsers']) ? 'active' : ''; ?>">
        <a class="nav-link <?php echo in_array($current_page, ['addUsers', 'listUsers']) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-cog"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse <?php echo in_array($current_page, ['addUsers', 'listUsers']) ? 'show' : ''; ?>" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users:</h6>
                <a class="collapse-item <?php echo $current_page == 'addUsers' ? 'active' : ''; ?>" href="admin.php?action=addUsers">Add User</a>
                <a class="collapse-item <?php echo $current_page == 'listUsers' ? 'active' : ''; ?>" href="admin.php?action=listUsers">View Users</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Categories Collapse Menu -->
    <li class="nav-item <?php echo in_array($current_page, ['addProductCategory', 'listCategories']) ? 'active' : ''; ?>">
        <a class="nav-link <?php echo in_array($current_page, ['addProductCategory', 'listCategories']) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Categories</span>
        </a>
        <div id="collapseCategories" class="collapse <?php echo in_array($current_page, ['addProductCategory', 'listCategories']) ? 'show' : ''; ?>" aria-labelledby="headingCategories" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Categories:</h6>
                <a class="collapse-item <?php echo $current_page == 'addProductCategory' ? 'active' : ''; ?>" href="admin.php?action=addProductCategory">Add Category</a>
                <a class="collapse-item <?php echo $current_page == 'listCategories' ? 'active' : ''; ?>" href="admin.php?action=listCategories">View Categories</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Brands Collapse Menu -->
    <li class="nav-item <?php echo in_array($current_page, ['addBrand', 'listBrands']) ? 'active' : ''; ?>">
        <a class="nav-link <?php echo in_array($current_page, ['addBrand', 'listBrands']) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseBrands" aria-expanded="true" aria-controls="collapseBrands">
            <i class="fas fa-fw fa-cog"></i>
            <span>Brands</span>
        </a>
        <div id="collapseBrands" class="collapse <?php echo in_array($current_page, ['addBrand', 'listBrands']) ? 'show' : ''; ?>" aria-labelledby="headingBrands" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Brands:</h6>
                <a class="collapse-item <?php echo $current_page == 'addBrand' ? 'active' : ''; ?>" href="admin.php?action=addBrand">Add Brand</a>
                <a class="collapse-item <?php echo $current_page == 'listBrands' ? 'active' : ''; ?>" href="admin.php?action=listBrands">View Brands</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo in_array($current_page, ['addPage', 'listPages']) ? 'active' : ''; ?>">
        <a class="nav-link <?php echo in_array($current_page, ['addPage', 'listPages']) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse <?php echo in_array($current_page, ['addPage', 'listPage']) ? 'show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pages:</h6>
                <a class="collapse-item <?php echo $current_page == 'addPage' ? 'active' : ''; ?>" href="admin.php?action=addPage">Add Page</a>
                <a class="collapse-item <?php echo $current_page == 'listPage' ? 'active' : ''; ?>" href="admin.php?action=listPage">View Pages</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - States Collapse Menu -->
    <li class="nav-item <?php echo in_array($current_page, ['addState', 'listStates']) ? 'active' : ''; ?>">
        <a class="nav-link <?php echo in_array($current_page, ['addState', 'listStates']) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseStates" aria-expanded="true" aria-controls="collapseStates">
            <i class="fas fa-fw fa-cog"></i>
            <span>States</span>
        </a>
        <div id="collapseStates" class="collapse <?php echo in_array($current_page, ['addState', 'listStates']) ? 'show' : ''; ?>" aria-labelledby="headingStates" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">States:</h6>
                <a class="collapse-item <?php echo $current_page == 'addState' ? 'active' : ''; ?>" href="admin.php?action=addState">Add State</a>
                <a class="collapse-item <?php echo $current_page == 'listStates' ? 'active' : ''; ?>" href="admin.php?action=listStates">View States</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Countries Collapse Menu -->
    <li class="nav-item <?php echo in_array($current_page, ['addCountry', 'listCountries']) ? 'active' : ''; ?>">
        <a class="nav-link <?php echo in_array($current_page, ['addCountry', 'listCountries']) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseCountries" aria-expanded="true" aria-controls="collapseCountries">
            <i class="fas fa-fw fa-cog"></i>
            <span>Countries</span>
        </a>
        <div id="collapseCountries" class="collapse <?php echo in_array($current_page, ['addCountry', 'listCountries']) ? 'show' : ''; ?>" aria-labelledby="headingCountries" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Countries:</h6>
                <a class="collapse-item <?php echo $current_page == 'addCountry' ? 'active' : ''; ?>" href="admin.php?action=addCountry">Add Country</a>
                <a class="collapse-item <?php echo $current_page == 'listCountries' ? 'active' : ''; ?>" href="admin.php?action=listCountries">View Countries</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - discounts Collapse Menu -->
    <li class="nav-item <?php echo in_array($current_page, ['addDiscount', 'listDiscounts']) ? 'active' : ''; ?>">
        <a class="nav-link <?php echo in_array($current_page, ['addDiscount', 'listDiscounts']) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseDiscounts" aria-expanded="true" aria-controls="collapseDiscounts">
            <i class="fas fa-fw fa-cog"></i>
            <span>Discounts</span>
        </a>
        <div id="collapseDiscounts" class="collapse <?php echo in_array($current_page, ['addDiscount', 'listDiscounts']) ? 'show' : ''; ?>" aria-labelledby="headingDiscounts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Discounts:</h6>
                <a class="collapse-item <?php echo $current_page == 'addDiscount' ? 'active' : ''; ?>" href="admin.php?action=addDiscount">Add Discount</a>
                <a class="collapse-item <?php echo $current_page == 'listDiscounts' ? 'active' : ''; ?>" href="admin.php?action=listDiscounts">View Discounts</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - orders Collapse Menu -->
    <li class="nav-item <?php echo in_array($current_page, ['listOrders']) ? 'active' : ''; ?>">
        <a class="nav-link <?php echo in_array($current_page, ['listOrders']) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true" aria-controls="collapseOrders">
            <i class="fas fa-fw fa-cog"></i>
            <span>Orders</span>
        </a>
        <div id="collapseOrders" class="collapse <?php echo in_array($current_page, ['listOrders']) ? 'show' : ''; ?>" aria-labelledby="headingOrders" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Orders:</h6>
                <a class="collapse-item <?php echo $current_page == 'listOrders' ? 'active' : ''; ?>" href="admin.php?action=listOrders">View Orders</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
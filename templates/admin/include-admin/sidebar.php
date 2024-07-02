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
        <div id="collapsePages" class="collapse <?php echo in_array($current_page, ['addPage', 'listPages']) ? 'show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pages:</h6>
                <a class="collapse-item <?php echo $current_page == 'addPage' ? 'active' : ''; ?>" href="admin.php?action=addPage">Add Page</a>
                <a class="collapse-item <?php echo $current_page == 'listPage' ? 'active' : ''; ?>" href="admin.php?action=listPage">View Pages</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<?php include 'templates/admin/include-admin/admin-header.php'; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">WP Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Products</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Products:</h6>
                        <a class="collapse-item" href="?action=addProduct">Add Product</a>
                        <a class="collapse-item " href="?action=listProducts">View Products</a>
                    </div>
                </div>
            </li>



            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- /.container-fluid -->
                <div class="container">
                    <h2>Product Details</h2>
                    <div class="panel panel-widget">
                        <!-- <div class="panel-title">
            Product Details
        </div> -->
                        <?php if (isset($product)) : ?>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="productCategory" style="font-weight: bold;">Product Category</label>
                                    <p id="productCategory" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->category_name); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="brand" style="font-weight: bold;">Brand</label>
                                    <p id="brand" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->brand_name); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_name" style="font-weight: bold;">Product Name</label>
                                    <p id="product_name" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_name ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_desc" style="font-weight: bold;">Product Description</label>
                                    <p id="product_desc" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_desc ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_small_desc" style="font-weight: bold;">Small Description</label>
                                    <p id="product_small_desc" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_small_desc ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_mrp" style="font-weight: bold;">Maximum Retail Price (MRP)</label>
                                    <p id="product_mrp" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_mrp ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_selling_price" style="font-weight: bold;">Selling Price</label>
                                    <p id="product_selling_price" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_selling_price ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_product_image_1" style="font-weight: bold;">Product Image 1</label>
                                    <p id="product_product_image_1" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_product_image_1 ?? ''); ?></p>
                                    <?php if (!empty($product->product_product_image_1)) { ?>
                                        <img src="<?php echo htmlspecialchars($product->product_product_image_1); ?>" alt="Product Image 1" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                    <?php } else { ?>
                                        <p>No Image Available</p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="product_product_image_2" style="font-weight: bold;">Product Image 2</label>
                                    <p id="product_product_image_2" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_product_image_2 ?? ''); ?></p>
                                    <?php if (!empty($product->product_product_image_2)) { ?>
                                        <img src="<?php echo htmlspecialchars($product->product_product_image_2); ?>" alt="Product Image 2" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                    <?php } else { ?>
                                        <p>No Image Available</p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="product_product_image_3" style="font-weight: bold;">Product Image 3</label>
                                    <p id="product_product_image_3" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_product_image_3 ?? ''); ?></p>
                                    <?php if (!empty($product->product_product_image_3)) { ?>
                                        <img src="<?php echo htmlspecialchars($product->product_product_image_3); ?>" alt="Product Image 3" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                    <?php } else { ?>
                                        <p>No Image Available</p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="product_stock" style="font-weight: bold;">Product Stock</label>
                                    <p id="product_stock" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_stock ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_shipping_time_est" style="font-weight: bold;">Shipping Time Estimate (days)</label>
                                    <p id="product_shipping_time_est" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_shipping_time_est ?? ''); ?></p>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="product_breadth" style="font-weight: bold;">Breadth (cm)</label>
                                        <p id="product_breadth" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_breadth ?? ''); ?></p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="product_volume" style="font-weight: bold;">Volume (cm³)</label>
                                        <p id="product_volume" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_volume ?? ''); ?></p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="product_height" style="font-weight: bold;">Height (cm)</label>
                                        <p id="product_height" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_height ?? ''); ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_weight" style="font-weight: bold;">Weight (kg)</label>
                                    <p id="product_weight" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_weight ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_tags" style="font-weight: bold;">Product Tags</label>
                                    <p id="product_tags" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_tags ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_tax" style="font-weight: bold;">Product Tax (%)</label>
                                    <p id="product_tax" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_tax ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_hsn_code" style="font-weight: bold;">HSN Code</label>
                                    <p id="product_hsn_code" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_hsn_code ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_certification" style="font-weight: bold;">Certification</label>
                                    <p id="product_certification" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_certification ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_barcode" style="font-weight: bold;">Barcode</label>
                                    <p id="product_barcode" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_barcode ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_sku" style="font-weight: bold;">SKU</label>
                                    <p id="product_sku" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_sku ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_code" style="font-weight: bold;">Product Code</label>
                                    <p id="product_code" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_code ?? ''); ?></p>
                                </div>
                                <div class="form-group" >
                                    <label for="product_warranty" style="font-weight: bold;">Warranty</label>
                                    <p id="product_warranty" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_warranty ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_guarantee" style="font-weight: bold;">Guarantee</label>
                                    <p id="product_guarantee" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_guarantee ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_offer_code" style="font-weight: bold;">Offer Code</label>
                                    <p id="product_offer_code" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_offer_code ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_features" style="font-weight: bold;">Product Features</label>
                                    <p id="product_features" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_features ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_created_on" style="font-weight: bold;">Created On</label>
                                    <p id="product_created_on" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_created_on ?? ''); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="product_updated_on" style="font-weight: bold;">Updated On</label>
                                    <p id="product_updated_on" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($product->product_updated_on ?? ''); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <button class="btn btn-primary" onclick="window.history.back();">Back</button>
                    </div>
                </div>


                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'templates/admin/include-admin/scripts.php'; ?>


</body>

</html>
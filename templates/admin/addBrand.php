<?php include 'templates/admin/include-admin/admin-header.php'; ?>



                <!-- /.container-fluid -->

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?php echo htmlspecialchars($results['pageTitle']); ?></h1>

                    <!-- Form -->
                    <form action="admin.php?action=<?php echo $results['formAction']; ?>" method="post">
                        <?php if (!empty($results['brand']->brand_id)) { ?>
                            <input type="hidden" name="brand_id" value="<?php echo htmlspecialchars($results['brand']->brand_id) ?>" />
                        <?php } ?> <div class="form-group">
                            <label for="brandName">Brand Name</label>
                            <input type="text" class="form-control" id="brandName" name="brand_name" placeholder="Enter brand name" required value="<?php echo htmlspecialchars($results['brand']->brand_name) ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="saveChanges" value="Save Changes">
                            <a href="admin.php?action=listBrands" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
                <!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>

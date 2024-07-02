<?php include 'templates/admin/include-admin/admin-header.php'; ?>



                <!-- /.container-fluid -->

                <div class="content">
                    <div class="women_main">
                        <div class="grids">
                            <div class="progressbar-heading grids-heading">
                                <h2>Add Category</h2>
                            </div>
                            <div class="panel panel-widget">
                                <div class="panel-title">
                                    Category Form
                                </div>
                                <div class="panel-body">
                                    <form action="admin.php?action=<?php echo $results['formAction'] ?>" method="post" enctype="multipart/form-data">
                                        <?php if (!empty($results['category']->category_id)) { ?>
                                            <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($results['category']->category_id) ?>" />
                                        <?php } ?>
                                        <div class="form-group">
                                            <label for="brand_name">Category Name:</label>
                                            <input type="text" class="form-control" id="category_name" name="category_name" maxlength="255" required value="<?php echo htmlspecialchars($results['category']->category_name) ?>"">
                    </div>

                    <div class=" form-group">
                                            <label for="brand_name">Category Description:</label>
                                            <input type="text" class="form-control" id="category_description" name="category_description" maxlength="255" required value="<?php echo htmlspecialchars($results['category']->category_description) ?>"">
                    </div>
<div class=" form-group">
                                            <input type="submit" name="saveChanges" value="Save Changes" class="btn btn-primary">
                                            <input type="submit" formnovalidate name="cancel" value="Cancel" class="btn btn-secondary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>

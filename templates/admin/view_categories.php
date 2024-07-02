<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- /.container-fluid -->



<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results['categories'] as $category) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($category->category_id); ?></td>
                                <td><?php echo htmlspecialchars($category->category_name); ?></td>
                                <td><?php echo htmlspecialchars($category->category_description); ?></td>
                                <td>
                                    <!-- Add/Edit/Delete buttons here -->
                                    <a href="admin.php?action=editProductCategory&category_id=<?php echo $category->category_id; ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="admin.php?action=deleteProductCategory&category_id=<?php echo $category->category_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
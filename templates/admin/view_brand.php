<?php include 'templates/admin/include-admin/admin-header.php'; ?>






<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <?php if (!empty($results['errorMessage'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $results['errorMessage']; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($results['statusMessage'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $results['statusMessage']; ?>
        </div>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Brands</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results['brands'] as $brand) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($brand->brand_id); ?></td>
                                <td><?php echo htmlspecialchars($brand->brand_name); ?></td>
                                <td>
                                    <!-- Add/Edit/Delete buttons here -->
                                    <a href="admin.php?action=editBrand&brand_id=<?php echo $brand->brand_id; ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="admin.php?action=deleteBrand&brand_id=<?php echo $brand->brand_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
                <p class="mt-3">Total Brands: <?php echo $results['totalRows']; ?></p>
            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
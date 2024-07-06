<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- /.container-fluid -->



<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">States</h6>
        </div>
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>GST Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results['states'] as $state) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($state->state_id); ?></td>
                                <td><?php echo htmlspecialchars($state->state_name); ?></td>
                                <td><?php echo htmlspecialchars($state->state_gst_code); ?></td>
                                <td>
                                    <!-- Add/Edit/Delete buttons here -->
                                    <a href="admin.php?action=editState&state_id=<?php echo $state->state_id; ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="admin.php?action=deleteState&state_id=<?php echo $state->state_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="mt-3">Total States: <?php echo $results['totalRows']; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
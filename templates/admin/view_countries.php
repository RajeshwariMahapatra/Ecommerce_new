<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- /.container-fluid -->



<!-- Begin Coutnry Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Countries</h6>
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
                            <th>Country Code</th>
                            <th>Country Curreny</th>
                            <th>Country Language</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results['countries'] as $country) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($country->country_id); ?></td>
                                <td><?php echo htmlspecialchars($country->country_name); ?></td>
                                <td><?php echo htmlspecialchars($country->country_code); ?></td>
                                <td><?php echo htmlspecialchars($country->country_currency); ?></td>
                                <td><?php echo htmlspecialchars($country->country_language); ?></td>
                                <td>
                                    <!-- Add/Edit/Delete buttons here -->
                                    <a href="admin.php?action=editCountry&country_id=<?php echo $country->country_id; ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="admin.php?action=deleteCountry&country_id=<?php echo $country->country_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="mt-3">Total Countries: <?php echo $results['totalRows']; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
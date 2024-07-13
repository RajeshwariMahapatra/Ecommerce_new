<?php include 'templates/admin/include-admin/admin-header.php'; ?>

<!-- /.container-fluid -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title">All Discounts</h2>

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

            <ul class="list-group">
                <?php foreach ($results['discounts'] as $discounts) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <a href="admin.php?action=viewDiscount&discount_id=<?php echo $discounts->discount_id; ?>" class="text-decoration-none">
                                <strong>Code:</strong> <?php echo htmlspecialchars($discounts->discount_code); ?>
                                <br>
                                <?php echo htmlspecialchars($discounts->discount_type); ?> - <?php echo htmlspecialchars($discounts->discount_value); ?>
                            </a>
                        </div>
                        <div class="btn-group" role="group" aria-label="Discount Actions">
                            <a href="admin.php?action=editDiscount&discount_id=<?php echo $discounts->discount_id; ?>" class="btn btn-primary btn-sm">Update</a>
                            <a href="admin.php?action=deleteDiscount&discount_id=<?php echo $discounts->discount_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p class="mt-3">Total Discounts: <?php echo $results['totaldiscountRows']; ?></p>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>

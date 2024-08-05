<?php include 'templates/admin/include-admin/admin-header.php'; ?>
<!-- /.container-fluid -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title">All Orders</h2>

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
            <?php foreach ($results['orders'] as $order) : ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="admin.php?action=listOrders2&order_id=<?php echo $order->order_id; ?>">
            <strong>Order ID:</strong> <?php echo htmlspecialchars($order->order_id); ?>
            <br>
            <strong>Total:</strong> <?php echo htmlspecialchars($order->order_total); ?>
        </a>
        <div class="btn-group" role="group" aria-label="Page Actions">
            <a href="admin.php?action=editOrder&order_id=<?php echo $order->order_id; ?>" class="btn btn-primary btn-sm">Update</a>
            <a href="admin.php?action=deleteOrder&order_id=<?php echo $order->order_id; ?>" class="btn btn-danger btn-sm">Delete</a>
        </div>
    </li>
<?php endforeach; ?>

            </ul>

            <p class="mt-3">Total Orders: <?php echo $results['totalRows']; ?></p>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>

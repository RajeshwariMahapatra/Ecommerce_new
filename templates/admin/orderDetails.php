<?php include 'include-admin/admin-header.php'; ?>
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title">Order Details</h2>

            <div class="mb-3">
                <strong>Order ID:</strong> <?php echo htmlspecialchars($order->order_id); ?><br>
                <strong>Order Identity:</strong> <?php echo htmlspecialchars($order->order_identity); ?><br>
                <strong>User Name:</strong> <?php echo htmlspecialchars($order->user_name); ?><br>
                <strong>User Email:</strong> <?php echo htmlspecialchars($order->user_email); ?><br>
                <strong>Total:</strong> <?php echo htmlspecialchars($order->order_total); ?><br>
                <strong>Status:</strong> <?php echo htmlspecialchars($order->order_status); ?><br>
                <strong>Created At:</strong> <?php echo htmlspecialchars($order->order_created_at); ?><br>
                <strong>Delivery Address:</strong><br>
                <?php echo htmlspecialchars($order->delivery_address_line1); ?><br>
                <?php if ($order->delivery_address_line2) echo htmlspecialchars($order->delivery_address_line2) . '<br>'; ?>
                <?php echo htmlspecialchars($order->delivery_city); ?><br>
                <?php echo htmlspecialchars($order->state_name); ?><br>
                <?php echo htmlspecialchars($order->country_name); ?><br>
                <?php echo htmlspecialchars($order->delivery_pin_code); ?><br>
            </div>

            <h3>Order Items</h3>
            <ul class="list-group">
                <?php foreach ($order->items as $item) : ?>
                    <li class="list-group-item">
                        <strong>Product:</strong> <?php echo htmlspecialchars($item->product_name); ?><br>
                        <strong>Price:</strong> <?php echo htmlspecialchars($item->product_price); ?><br>
                        <strong>Quantity:</strong> <?php echo htmlspecialchars($item->quantity); ?><br>
                        <strong>Subtotal:</strong> <?php echo htmlspecialchars($item->subtotal); ?><br>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="btn-group mt-3" role="group" aria-label="Page Actions">
                <a href="admin.php?action=editOrder&order_id=<?php echo $order->order_id; ?>" class="btn btn-primary btn-sm">Update</a>
                <a href="admin.php?action=deleteOrder&order_id=<?php echo $order->order_id; ?>" class="btn btn-danger btn-sm">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php include 'include-admin/footer.php'; ?>

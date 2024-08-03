<?php include 'templates/include/user_header.php'; ?>

<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.php?action=home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Order History</li>
        </ol>
    </div>
</div>

<!-- order history -->
<div class="order-history">
    <div class="container">
        <h3 class="animated wow slideInLeft" data-wow-delay=".5s">Your Order History</h3>
        <div class="order-history-content">
            <table class="table table-bordered animated wow slideInUp" data-wow-delay=".5s">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Products</th>
                        <th>Prices</th>
                        <th>Quantities</th>
                        <th>Subtotals</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($results['orderItems'])): ?>
                        <?php foreach ($results['orderItems'] as $orderItem): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($orderItem['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($orderItem['products']); ?></td>
                                <td><?php echo htmlspecialchars($orderItem['prices']); ?></td>
                                <td><?php echo htmlspecialchars($orderItem['quantities']); ?></td>
                                <td><?php echo htmlspecialchars($orderItem['subtotals']); ?></td>
                                <td><?php echo htmlspecialchars($orderItem['order_created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- //order history -->

<!-- footer -->
<?php include 'templates/include/user_footer.php'; ?>

<?php include 'templates/admin/include-admin/admin-header.php'; ?>

<!-- /.container-fluid -->
<div class="container mt-4">
    <div class="card shadow mb-4">
        <!-- Card Header - Form Title -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order Status</h6>
        </div>

        <!-- Display Error Message -->
        <?php if (isset($errorcode) && $errorcode != 200) : ?>
            <div class="alert alert-danger">
                <ul>
                    <p><?php echo $errorstatus; ?></p>
                </ul>
            </div>
        <?php endif; ?>
        <!-- Card Body - Form Content -->
        <div class="card-body">
            <form action="admin.php?action=<?php echo $results['formAction'] ?>" method="post">
                <?php if (!empty($results['order']->order_id)) { ?>
                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($results['order']->order_id) ?>" />
                <?php } ?>

                <!-- Order Status -->
                <div class="form-group">
                    <label for="order_status">Order Status:</label>
                    <select name="order_status" id="order_status" class="form-control" required>
                        <option value="Pending" <?php echo ($results['order']->order_status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Processing" <?php echo ($results['order']->order_status == 'Processing') ? 'selected' : ''; ?>>Processing</option>
                        <option value="Completed" <?php echo ($results['order']->order_status == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                        <option value="Cancelled" <?php echo ($results['order']->order_status == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                </div>

                <!-- Submit Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="saveChanges">Save Order</button>
                    <button type="submit" formnovalidate class="btn btn-secondary" name="cancel">Cancel</button>
                </div>
            </form>

            <?php if ($results['order']->order_id) { ?>
                <p><a href="admin.php?action=deleteOrder&amp;order_id=<?php echo $results['order']->order_id ?>" onclick="return confirm('Delete This Order?')">Delete This Order</a></p>
            <?php } ?>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<?php include 'templates/admin/include-admin/footer.php'; ?>

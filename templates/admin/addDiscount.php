<?php include 'templates/admin/include-admin/admin-header.php'; ?>

<!-- container-fluid -->
<div class="container">
    <h1>Add Discount</h1>
    <form action="admin.php?action=<?php echo $results['formAction'] ?>" method="post">
        <?php if (!empty($results['discounts']->discount_id)) { ?>
            <input type="hidden" name="discount_id" value="<?php echo htmlspecialchars($results['discounts']->discount_id) ?>" />
        <?php } ?>
        
        <div class="form-group">
            <label for="discount_code">Discount Code</label>
            <input type="text" id="discount_code" name="discount_code" class="form-control" required value="<?php echo htmlspecialchars($results['discounts']->discount_code) ?>">
        </div>
        
        <div class="form-group">
            <label for="discount_type">Discount Type</label>
            <select id="discount_type" name="discount_type" class="form-control" required>
                <option value="percentage" <?php echo $results['discounts']->discount_type == 'percentage' ? 'selected' : '' ?>>Percentage</option>
                <option value="fixed" <?php echo $results['discounts']->discount_type == 'fixed' ? 'selected' : '' ?>>Fixed Amount</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="discount_value">Discount Value</label>
            <input type="number" step="0.01" id="discount_value" name="discount_value" class="form-control" required value="<?php echo htmlspecialchars($results['discounts']->discount_value) ?>">
        </div>
        
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" class="form-control" required value="<?php echo htmlspecialchars($results['discounts']->start_date) ?>">
        </div>
        
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control" required value="<?php echo htmlspecialchars($results['discounts']->end_date) ?>">
        </div>
        
        <div class="form-group">
            <label for="minimum_order_value">Minimum Order Value</label>
            <input type="number" step="0.01" id="minimum_order_value" name="minimum_order_value" class="form-control" value="<?php echo htmlspecialchars($results['discounts']->minimum_order_value) ?>">
        </div>
        
        <div class="form-group">
            <label for="usage_limit">Usage Limit</label>
            <input type="number" id="usage_limit" name="usage_limit" class="form-control" value="<?php echo htmlspecialchars($results['discounts']->usage_limit) ?>">
        </div>

        <input type="submit" name="saveChanges" value="Save Changes" class="btn btn-primary">
        <input type="submit" formnovalidate name="cancel" value="Cancel" class="btn btn-secondary">
    </form>
    <br>
    <?php if ($results['discounts']->discount_id) { ?>
        <p><a href="admin.php?action=deleteDiscount&amp;discount_id=<?php echo $results['discounts']->discount_id ?>" onclick="return confirm('Delete This Discount?')">Delete This Discount</a></p>
    <?php } ?>
</div>
<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>

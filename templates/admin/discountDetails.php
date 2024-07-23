<?php include 'templates/admin/include-admin/admin-header.php'; ?>


<!-- /.container-fluid -->
<div class="container">
    <h2>Discount Details</h2>
    <div class="panel panel-widget">
        <!-- <div class="panel-title">
            Product Details
        </div> -->
        <?php if (isset($discount)) : ?>
            <div class="panel-body">

                <div class="form-group">
                    <label for="discount_code" style="font-weight: bold;">Discount Code</label>
                    <p id="discount_code" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['discount']->discount_code); ?></p>
                </div>
                <div class="form-group">
                    <label for="discount_type" style="font-weight: bold;">Discount type</label>
                    <p id="discount_type" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['discount']->discount_type); ?></p>
                </div>
                <div class="form-group">
                    <label for="discount_value" style="font-weight: bold;">Discount value</label>
                    <p id="discount_value" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['discount']->discount_value); ?></p>
                </div>
                <div class="form-group">
                    <label for="start_date" style="font-weight: bold;">Start Date</label>
                    <p id="start_date" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['discount']->start_date); ?></p>
                </div>
                <div class="form-group">
                    <label for="end_date" style="font-weight: bold;">End Date</label>
                    <p id="end_date" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['discount']->end_date); ?></p>
                </div>
                <div class="form-group">
                    <label for="minimum_order_value" style="font-weight: bold;">Minimum Order Value</label>
                    <p id="minimum_order_value" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['discount']->minimum_order_value); ?></p>
                </div>
                <div class="form-group">
                    <label for="usage_limit" style="font-weight: bold;">Usage Limit</label>
                    <p id="usage_limit" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['discount']->usage_limit); ?></p>
                </div>
                <div class="form-group">
                    <label for="times_used" style="font-weight: bold;">Times Used</label>
                    <p id="times_used" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['discount']->times_used); ?></p>
                </div>
                
            </div>
        <?php endif; ?>


        <button class="btn btn-primary" onclick="window.history.back();">Back</button>
    </div>
</div>


<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
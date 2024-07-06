<?php include 'templates/admin/include-admin/admin-header.php'; ?>

<!-- /.container-fluid -->
<div class="container mt-4">
    <div class="card shadow mb-4">
        <!-- Card Header - Form Title -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
        </div>

        <!-- Card Body - User Content -->
        <div class="card-body">
            <?php if (isset($user)) : ?>
                <div class="form-group">
                    <label for="user_name" style="font-weight: bold;">User Name</label>
                    <p id="user_name" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['user']->user_name); ?></p>
                </div>
                <div class="form-group">
                    <label for="user_email" style="font-weight: bold;">User Email</label>
                    <p id="user_email" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['user']->user_email); ?></p>
                </div>
                <div class="form-group">
                    <label for="user_phone" style="font-weight: bold;">User Contact No.</label>
                    <p id="user_phone" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['user']->user_contact_no); ?></p>
                </div>
                <div class="form-group">
                    <label for="user_address" style="font-weight: bold;">User Address</label>
                    <p id="user_address" style="font-size: 0.9em; color: #555;">
                        <?php
                        echo htmlspecialchars($results['user']->user_address_line1) . ', ' .
                            htmlspecialchars($results['user']->user_address_line2) . ', ' .
                            htmlspecialchars($results['user']->user_address_city) . ', ' .
                            htmlspecialchars($results['user_state']) . ', ' .
                            htmlspecialchars($results['user_country']) . ' - ' .
                            htmlspecialchars($results['user']->user_address_pin_code);
                        ?>
                    </p>
                </div>
                <div class="form-group">
                    <label for="user_status" style="font-weight: bold;">User Status</label>
                    <p id="user_status" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['user']->user_status); ?></p>
                </div>
                <div class="form-group">
                    <label for="user_created_at" style="font-weight: bold;">User Created At</label>
                    <p id="user_created_at" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['user']->user_created_at); ?></p>
                </div>
            <?php endif; ?>

            <button class="btn btn-primary" onclick="window.history.back();">Back</button>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
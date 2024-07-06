<?php include 'templates/admin/include-admin/admin-header.php'; ?>

<!-- /.container-fluid -->
<div class="container mt-4">
    <div class="card shadow mb-4">
        <!-- Card Header - Form Title -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
        </div>

        <!-- Display Error Message -->
        <?php if (isset($errorcode) && $errorcode != 200) : ?>
            <div class="alert alert-danger">
                <ul>
                    <li><?php echo $errorstatus; ?></li>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Card Body - Form Content -->
        <div class="card-body">
            <form action="admin.php?action=<?php echo $results['formAction'] ?>" method="post" enctype="multipart/form-data" validate="validate">
                <?php if (!empty($results['user']->user_id)) { ?>
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($results['user']->user_id) ?>" />
                <?php } ?>

                <!-- User Name -->
                <div class="form-group">
                    <label for="user_name">User Name:</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter user name" value="<?php echo htmlspecialchars($results['user']->user_name) ?>" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="user_email">Email:</label>
                    <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter user email" value="<?php echo htmlspecialchars($results['user']->user_email) ?>" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="user_password">Password:</label>
                    <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter user password" value="<?php echo htmlspecialchars($results['user']->user_password) ?>" required>
                </div>

                <!-- Country Code -->
                <div class="form-group">
                    <label for="user_country_code">Country Code:</label>
                    <input type="text" class="form-control" id="user_country_code" name="user_country_code" placeholder="Enter user country code" value="<?php echo htmlspecialchars($results['user']->user_country_code) ?>" required>
                </div>

                <!-- Contact No -->
                <div class="form-group">
                    <label for="user_contact_no">Contact No:</label>
                    <input type="text" class="form-control" id="user_contact_no" name="user_contact_no" placeholder="Enter user contact no" value="<?php echo htmlspecialchars($results['user']->user_contact_no) ?>" required>
                </div>

                <!-- Birthdate -->
                <div class="form-group">
                    <label for="user_birthdate">Birthdate:</label>
                    <input type="date" class="form-control" id="user_birthdate" name="user_birthdate" placeholder="Enter user birthdate" value="<?php echo htmlspecialchars($results['user']->user_birthdate) ?>" required>
                </div>

                <!-- Address Line 1 -->
                <div class="form-group">
                    <label for="user_address_line1">Address Line 1:</label>
                    <input type="text" class="form-control" id="user_address_line1" name="user_address_line1" placeholder="Enter address line 1" value="<?php echo htmlspecialchars($results['user']->user_address_line1) ?>" required>
                </div>

                <!-- Address Line 2 -->
                <div class="form-group">
                    <label for="user_address_line2">Address Line 2:</label>
                    <input type="text" class="form-control" id="user_address_line2" name="user_address_line2" placeholder="Enter address line 2" value="<?php echo htmlspecialchars($results['user']->user_address_line2) ?>">
                </div>

                <!-- City -->
                <div class="form-group">
                    <label for="user_address_city">City:</label>
                    <input type="text" class="form-control" id="user_address_city" name="user_address_city" placeholder="Enter city" value="<?php echo htmlspecialchars($results['user']->user_address_city) ?>" required>
                </div>

                <!-- State -->
                <div class="form-group">
                    <label for="user_address_state_id">State:</label>
                    <select name="user_address_state_id" id="user_address_state_id" class="form-control" required>
                        <?php foreach ($results['states'] as $state) { ?>
                            <option value="<?php echo htmlspecialchars($state->state_id); ?>" <?php echo ($state->state_id == $results['user']->user_address_state_id) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($state->state_name); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Country -->
                <div class="form-group">
                    <label for="user_address_country_id">Country:</label>
                    <select name="user_address_country_id" id="user_address_country_id" class="form-control" required>
                        <?php foreach ($results['countries'] as $country) { ?>
                            <option value="<?php echo htmlspecialchars($country->country_id); ?>" <?php echo ($country->country_id == $results['user']->user_address_country_id) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($country->country_name); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Pin Code -->
                <div class="form-group">
                    <label for="user_address_pin_code">Pin Code:</label>
                    <input type="text" class="form-control" id="user_address_pin_code" name="user_address_pin_code" placeholder="Enter pin code" value="<?php echo htmlspecialchars($results['user']->user_address_pin_code) ?>" required>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="user_status">Status:</label>
                    <select class="form-control" id="user_status" name="user_status" required>
                        <option value="1" <?php echo $results['user']->user_status ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?php echo !$results['user']->user_status ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>

                <!-- Submit Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="saveChanges">Save User</button>
                    <button type="submit" formnovalidate name="cancel" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
            <?php if ($results['user']->user_id) { ?>
                <p><a href="admin.php?action=deleteUser&amp;user_id=<?php echo $results['user']->user_id ?>" onclick="return confirm('Delete This User?')">Delete This User</a></p>
            <?php } ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->















<?php include 'templates/admin/include-admin/footer.php'; ?>
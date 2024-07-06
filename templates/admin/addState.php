<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- /.container-fluid -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo htmlspecialchars($results['pageTitle']); ?></h1>
    <form action="admin.php?action=<?php echo $results['formAction'] ?>" method="post" enctype="multipart/form-data">
        <?php if (!empty($results['state']->state_id)) { ?>
            <input type="hidden" name="state_id" value="<?php echo htmlspecialchars($results['state']->state_id) ?>" />
        <?php } ?>
        <div class="form-group">
            <label for="state_name">State Name:</label>
            <input type="text" class="form-control" id="state_name" name="state_name" maxlength="255" required value="<?php echo htmlspecialchars($results['state']->state_name) ?>"">
                    </div>

                    <div class=" form-group">
            <label for="state_gst_code">State GST Code:</label>
            <input type="text" class="form-control" id="state_gst_code" name="state_gst_code" maxlength="255" required value="<?php echo htmlspecialchars($results['state']->state_gst_code) ?>"">
                    </div>
<div class=" form-group">
            <input type="submit" name="saveChanges" value="Save Changes" class="btn btn-primary">
            <input type="submit" formnovalidate name="cancel" value="Cancel" class="btn btn-secondary">
        </div>
    </form>
</div>

<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- /.container-fluid -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo htmlspecialchars($results['pageTitle']); ?></h1>
    <form action="admin.php?action=<?php echo $results['formAction'] ?>" method="post" enctype="multipart/form-data">
        <?php if (!empty($results['country']->country_id)) { ?>
            <input type="hidden" name="country_id" value="<?php echo htmlspecialchars($results['country']->country_id) ?>" />
        <?php } ?>
        <div class="form-group">
            <label for="country_name">Country Name:</label>
            <input type="text" class="form-control" id="country_name" name="country_name" maxlength="255" required value="<?php echo htmlspecialchars($results['country']->country_name) ?>"">
                    </div>

                    <div class=" form-group">
            <label for="country_code">Country Code:</label>
            <input type="text" class="form-control" id="country_code" name="country_code" maxlength="255" required value="<?php echo htmlspecialchars($results['country']->country_code) ?>"">
                    </div>
                    <div class=" form-group">
            <label for="country_currency">Country Currency:</label>
            <input type="text" class="form-control" id="country_currency" name="country_currency" maxlength="255" required value="<?php echo htmlspecialchars($results['country']->country_currency) ?>"">
                    </div>
                    <div class=" form-group">
            <label for="country_language">Country Language:</label>
            <input type="text" class="form-control" id="country_language" name="country_language" maxlength="255" required value="<?php echo htmlspecialchars($results['country']->country_language) ?>"">
                    </div>
<div class=" form-group">
            <input type="submit" name="saveChanges" value="Save Changes" class="btn btn-primary">
            <input type="submit" formnovalidate name="cancel" value="Cancel" class="btn btn-secondary">
        </div>
    </form>
</div>

<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
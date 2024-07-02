<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- container-fluid -->
<div class="container">
    <h1>Add Page</h1>
    <form action="admin.php?action=<?php echo $results['formAction'] ?>" method="post" enctype="multipart/form-data">
        <?php if (!empty($results['page']->page_id)) { ?>
            <input type="hidden" name="page_id" value="<?php echo htmlspecialchars($results['page']->page_id) ?>" />
        <?php } ?> <div class="form-group">
            <label for="page_heading">Page Heading</label>
            <input type="text" id="page_heading" name="page_heading" class="form-control" required value="<?php echo htmlspecialchars($results['page']->page_heading) ?>">
        </div>
        <div class="form-group">
            <label for="page_subheading">Page Subheading</label>
            <input type="text" id="page_subheading" name="page_subheading" class="form-control" value="<?php echo htmlspecialchars($results['page']->page_subheading) ?>">
        </div>
        <div class="form-group">
            <label for="page_coverimage">Cover Image</label>
            <?php if ($results['page'] && $imagePath = $results['page']->{"page_coverimage"}) : ?>
            <div>
                <img id="page_coverimage" src="<?php echo htmlspecialchars($imagePath); ?>" alt="Cover Image" style="max-width: 200px; max-height: 200px;" />
            </div>
            <?php endif; ?>

            <input type="file" name="page_coverimage" id="page_coverimage" class="form-control">
        </div>
        <div class="form-group">
            <label for="page_content">Content</label>
            <textarea id="page_content" name="page_content" class="form-control mySummernote" required><?php echo htmlspecialchars($results['page']->page_content) ?></textarea>
        </div>
        <div class="form-group">
            <label for="page_preference">Page Preference</label>
            <input type="number" id="page_preference" name="page_preference" class="form-control" required value="<?php echo htmlspecialchars($results['page']->page_preference) ?>">
        </div>
        <div class="form-group">
            <label for="page_on_navbar">Show on Navbar</label>
            <select id="page_on_navbar" name="page_on_navbar" class="form-control" required value="<?php echo htmlspecialchars($results['page']->page_on_navbar) ?>">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <input type="submit" name="saveChanges" value="Save Changes" class="btn btn-primary">
        <input type="submit" formnovalidate name="cancel" value="Cancel" class="btn btn-secondary">
    </form>
    <br>
    <?php if ($results['page']->page_id) { ?>
        <p><a href="admin.php?action=deletePage&amp;page_id=<?php echo $results['page']->page_id ?>" onclick="return confirm('Delete This Page?')">Delete This Page</a></p>
    <?php } ?>
</div>
<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
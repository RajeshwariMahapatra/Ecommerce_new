<?php include 'templates/admin/include-admin/admin-header.php'; ?>


<!-- /.container-fluid -->
<div class="container">
    <h2>Page Details</h2>
    <div class="panel panel-widget">
        <!-- <div class="panel-title">
            Product Details
        </div> -->
        <?php if (isset($page)) : ?>
            <div class="panel-body">

                <div class="form-group">
                    <label for="page_heading" style="font-weight: bold;">Page Heading</label>
                    <p id="page_heading" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['page']->page_heading); ?></p>
                </div>
                <div class="form-group">
                    <label for="page_subheading" style="font-weight: bold;">Page Subheading</label>
                    <p id="page_subheading" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['page']->page_subheading); ?></p>
                </div>
                <div class="form-group">
                    <label for="page_coverimage" style="font-weight: bold;">Page Cover Image</label>
                    <p id="page_coverimage" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['page']->page_coverimage); ?></p>
                    <?php if (!empty($results['page']->page_coverimage)) { ?>
                        <img src="<?php echo htmlspecialchars($results['page']->page_coverimage); ?>" alt="Page Cover Image" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                    <?php } else { ?>
                        <p>No Image Available</p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="page_content" style="font-weight: bold;">Page Content</label>
                    <p id="page_content" style="font-size: 0.9em; color: #555;"><?php echo html_entity_decode($results['page']->page_content); ?></p>
                </div>
                <div class="form-group">
                    <label for="page_preference" style="font-weight: bold;">Page Preference</label>
                    <p id="page_preference" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['page']->page_preference); ?></p>
                </div>
                <div class="form-group">
                    <label for="page_on_navbar" style="font-weight: bold;">Page on Navbar</label>
                    <p id="page_on_navbar" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['page']->page_on_navbar); ?></p>
                </div>
                <div class="form-group">
                    <label for="page_created_at" style="font-weight: bold;">Page Created At</label>
                    <p id="page_created_at" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['page']->page_created_at); ?></p>
                </div>

            </div>
        <?php endif; ?>


        <button class="btn btn-primary" onclick="window.history.back();">Back</button>
    </div>
</div>


<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
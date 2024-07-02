<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- /.container-fluid -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title">All Pages</h2>

            <?php if (!empty($results['errorMessage'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $results['errorMessage']; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($results['statusMessage'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $results['statusMessage']; ?>
                </div>
            <?php endif; ?>

            <ul class="list-group">
                <?php foreach ($results['pages'] as $page) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <a href="admin.php?action=listPage2&page_id=<?php echo $page->page_id; ?>" class="text-decoration-none">
                                <strong>ID:</strong> <?php echo htmlspecialchars($page->page_id); ?>
                                <br>
                                <?php echo htmlspecialchars($page->page_heading); ?>
                            </a>
                        </div>
                        <div class="btn-group" role="group" aria-label="Page Actions">
                            <a href="admin.php?action=editPage&page_id=<?php echo $page->page_id; ?>" class="btn btn-primary btn-sm">Update</a>
                            <a href="admin.php?action=deletePage&page_id=<?php echo $page->page_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </li>
                    <?php endforeach; ?>
            </ul>


            <p class="mt-3">Total Pages: <?php echo $results['totalRows']; ?></p>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
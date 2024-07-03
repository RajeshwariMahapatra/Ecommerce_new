<?php include 'templates/include/user_header.php'; ?>

<!-- /.container-fluid -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pages</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Page Heading</th>
                            <th>Page Subheading</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results['pages'] as $page) : ?>
                            <tr>
                                <td>
                                    <a href="index.php?action=temporary&page_id=<?php echo $page->page_id; ?>">
                                        <?php echo htmlspecialchars($page->page_heading); ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?action=temporary&page_id=<?php echo $page->page_id; ?>">
                                        <?php echo htmlspecialchars($page->page_subheading); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

<?php include 'templates/include/user_footer.php'; ?>

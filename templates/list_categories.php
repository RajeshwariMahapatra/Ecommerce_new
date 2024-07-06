<?php include 'templates/include/user_header.php'; ?>

<!-- /.container-fluid -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($results['categories'] as $category) : ?>
        <tr>
            <td>
                <a href="index.php?action=products&category_id=<?php echo $category->category_id; ?>">
                    <?php echo htmlspecialchars($category->category_name); ?>
                </a>
            </td>
            <td> 
                <a href="index.php?action=products&category_id=<?php echo $category->category_id; ?>">
                    <?php echo htmlspecialchars($category->category_description); ?>
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

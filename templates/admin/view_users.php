<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- /.container-fluid -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title">All Users</h2>

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
                <?php foreach ($results['users'] as $user) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="admin.php?action=listUsers2&user_id=<?php echo $user->user_id; ?>">
                            <strong>ID:</strong> <?php echo htmlspecialchars($user->user_id); ?>
                            <br>
                            <?php echo htmlspecialchars($user->user_name); ?>
                        </a>
                        <div class="btn-group" role="group" aria-label="Page Actions">
                        <a href="admin.php?action=editUsers&user_id=<?php echo $user->user_id; ?>" class="btn btn-primary btn-sm">Update</a>
                        <a href="admin.php?action=deleteUser&user_id=<?php echo $user->user_id; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p class="mt-3">Total Users: <?php echo $results['totalRows']; ?></p>
        </div>
    </div>
</div>


<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
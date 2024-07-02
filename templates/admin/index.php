<?php include 'templates/admin/include-admin/admin-header.php'; ?>


<!-- /.container-fluid -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <div class="profile-details">
        <h2 class="admin-name">Hello <?php echo htmlspecialchars($_SESSION['username']) ?> </h2>
        <!-- <p class="admin-email">admin@example.com</p> -->
        <p class="admin-role">Super Admin </p>
        <p><a href="admin.php?action=logout" ?>Log out</a></p>
        <!-- <p class="last-login">Last Login: 2024-06-22 14:35</p> -->
    </div>
</div>
<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
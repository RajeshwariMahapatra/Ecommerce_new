<?php include("include/header.php"); ?>

<script src="templates/js/bootstrap.js"> </script>

<div class="items">
    <div class="container">
        <div class="items-sec">

            <ul>
                <?php foreach ($results['categories'] as $category) : ?>
                    <li><a href="users.php?action=viewProducts&category_id=<?php echo $category->category_id; ?>"><?php echo htmlspecialchars($category->category_name); ?></a></li>
                <?php endforeach; ?>
            </ul>


            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
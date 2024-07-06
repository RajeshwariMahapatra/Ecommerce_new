<?php include("include/header.php"); ?>

<script src="templates/js/bootstrap.js"> </script>

<div class="items">
    <div class="container">
        <div class="items-sec">

            <ul>
                <?php foreach ($results['pages'] as $page) : ?>
                    <li><a href="users.php?action=viewPages&page_id=<?php echo $page->page_id; ?>"><?php echo htmlspecialchars($page->page_heading); ?></a></li>
                <?php endforeach; ?>
            </ul>


            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
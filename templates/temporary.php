<?php include 'templates/include/user_header.php' ?>
<!-- //header -->
<!-- banner -->

<div class="jumbotron jumbotron-fluid " style="background-image: url('<?php echo htmlspecialchars($results['page']->page_coverimage); ?>'); background-size: cover; background-position: center; height: 400px; position: relative;">
    <div class="container text-white" style="position: absolute; bottom: 20px; left: 20px;">
        <h1 class="display-4" style="color: white;"><?php echo htmlspecialchars($results['page']->page_heading); ?></h1>
        <h2 class="h4" style="color: white;"><?php echo htmlspecialchars($results['page']->page_subheading); ?></h2>
    </div>
</div>

<!-- Page content section -->
<div class="container mt-5 mx-auto">
    <div class="row">
        <div class="col-12">
            <div class="content mb-5 ">
                <?php echo html_entity_decode($results['page']->page_content, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<div class="mb-5"></div>

<!-- //collections-bottom -->
<!-- footer -->

<?php include 'templates/include/user_footer.php' ?>
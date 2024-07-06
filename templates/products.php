<?php include 'templates/include/user_header.php' ?>
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li><a href="list_categories.php">Categories</a></li>
            <li class="active">Products</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- products -->
<div class="new-collections">
    <div class="container">
        <h3 class="animated wow zoomIn" data-wow-delay=".5s">Products</h3>
        <div class="new-collections-grids">
			<?php foreach ($results['products'] as $product) { ?>

				<div class="col-md-3 new-collections-grid">
					<div class="new-collections-grid1 animated wow slideInUp" data-wow-delay=".5s">
						<div class="new-collections-grid1-image">
							<a href="index.php?action=single&product_id=" <?php echo $product->product_id; ?> class="product-image"><img src="<?php echo $product->product_product_image_1; ?>" alt="<?php echo $product->product_name; ?>" class="img-responsive" /></a>
							<div class="new-collections-grid1-image-pos">
								<a href="index.php?action=single&product_id=<?php echo $product->product_id; ?>">Quick View</a>
							</div>
							<div class="new-collections-grid1-right">
								<div class="rating">

									<div class="rating-left">
										<img src="templates/images/2.png" alt=" " class="img-responsive" />
									</div>

									<div class="clearfix"> </div>
								</div>
							</div>
						</div>
						<h4><a href="index.php?action=single"><?php echo $product->product_name; ?></a></h4>
						<p><?php echo $product->product_small_desc; ?></p>
						<div class="new-collections-grid1-left simpleCart_shelfItem">
							<p><i>$<?php echo $product->product_selling_price; ?></i> <span class="item_price">$<?php echo $product->product_mrp; ?>
									<div class="occasion-cart">
										<a class="item_add" href="index.php?action=register">add to cart </a>
									</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
    </div>
</div>
<!-- //products -->
<!-- footer -->
<?php include 'templates/include/user_footer.php' ?>

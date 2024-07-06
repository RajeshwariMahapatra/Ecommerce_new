<?php include("include/header.php"); ?>
<script src="templates/web/js/responsiveslides.min.js"></script>
<script>
	$(function() {
		$("#slider").responsiveSlides({
			auto: false,
			nav: true,
			speed: 500,
			namespace: "callbacks",
			pager: false,
		});
	});
</script>
<div class="slider">
	<div class="callbacks_container">
		<ul class="rslides" id="slider">
			<li>
				<div class="banner1">
					<div class="banner-info">
						<h3>Morbi lacus hendrerit efficitur.</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. consectetur adipiscing elit. consectetur adipiscing elit.</p>
					</div>
				</div>
			</li>
			<li>
				<div class="banner2">
					<div class="banner-info">
						<h3>Phasellus elementum tincidunt.</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. consectetur adipiscing elit. consectetur adipiscing elit.</p>
					</div>
				</div>
			</li>
			<li>
				<div class="banner3">
					<div class="banner-info">
						<h3>Maecenas interposuere volutpat.</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. consectetur adipiscing elit. consectetur adipiscing elit.</p>
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>
<!---->
<script src="templates/js/bootstrap.js"> </script>

<div class="items">
	<div class="container">
		<div class="items-sec">

			<?php
			$counter = 0;
			foreach ($results['products'] as $product) {
				if ($counter >= 8) break;
			?>
				<div class="col-md-3 feature-grid">
					<a href="users.php?action=viewProductDetails&product_id=<?php echo $product->product_id; ?>"><img src=" <?php echo $product->product_product_image_1; ?>" alt="" />
					<div class="arrival-info">
						<h4><?php echo $product->product_name; ?></h4>
						<p><?php echo $product->product_selling_price; ?> Rs</p>
						<span class="pric1"><del><?php echo $product->product_mrp; ?> Rs</del></span>
						<?php
						// Calculate the discount percentage
						$discountPercentage = 0;
						if ($product->product_mrp > 0) {
							$discountPercentage = (($product->product_mrp - $product->product_selling_price) / $product->product_mrp) * 100;
						}
						?>
						<span class="disc">[<?php echo number_format($discountPercentage, 2); ?>% Off]</span>
					</div>
					<div class="viw">
						<a href="users.php?action=viewProductDetails&product_id=<?php echo $product->product_id; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>View</a>
					</div>
					</a>
				</div>
			<?php
				$counter++;
			}
			?>

			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!---->
<div class="offers">
	<div class="container">
		<h3>End of Season Sale</h3>
		<div class="offer-grids">
			<div class="col-md-6 grid-left">
				<a href="#">
					<div class="offer-grid1">
						<div class="ofr-pic">
							<img src="images/ofr2.jpeg" class="img-responsive" alt="" />
						</div>
						<div class="ofr-pic-info">
							<h4>Emergency Lights <br>& Led Bulds</h4>
							<span>UP TO 60% OFF</span>
							<p>Shop Now</p>
						</div>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
			<div class="col-md-6 grid-right">
				<a href="#">
					<div class="offer-grid2">
						<div class="ofr-pic-info2">
							<h4>Flat Discount</h4>
							<span>UP TO 30% OFF</span>
							<h5>Outdoor Gate Lights</h5>
							<p>Shop Now</p>
						</div>
						<div class="ofr-pic2">
							<img src="images/ofr3.jpg" class="img-responsive" alt="" />
						</div>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php include("include/footer.php"); ?>
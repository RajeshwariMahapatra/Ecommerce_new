<?php include("templates/web/include/header.php"); ?>

<div class="product">
	<div class="container">
		<div class="product-price1">
			<div class="top-sing">
				<div class="col-md-7 single-top">
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="<?php echo htmlspecialchars($results['product']->product_product_image_1); ?>">
								<div class="thumb-image">
									<img src="<?php echo htmlspecialchars($results['product']->product_product_image_1); ?>" data-imagezoom="true" class="img-responsive" alt="" />
								</div>
							</li>
							<li data-thumb="<?php echo htmlspecialchars($results['product']->product_product_image_2); ?>">
								<div class="thumb-image">
									<img src="<?php echo htmlspecialchars($results['product']->product_product_image_2); ?>" data-imagezoom="true" class="img-responsive" alt="" />
								</div>
							</li>
							<li data-thumb="<?php echo htmlspecialchars($results['product']->product_product_image_3); ?>">
								<div class="thumb-image">
									<img src="<?php echo htmlspecialchars($results['product']->product_product_image_3); ?>" data-imagezoom="true" class="img-responsive" alt="" />
								</div>
							</li>
						</ul>
					</div>
					<script src="templates/web/js/imagezoom.js"></script>
					<script defer src="templates/web/js/jquery.flexslider.js"></script>
					<script>
						$(window).load(function() {
							$('.flexslider').flexslider({
								animation: "slide",
								controlNav: "thumbnails"
							});
						});
					</script>
				</div>
				<div class="col-md-5 single-top-in simpleCart_shelfItem">
					<div class="single-para ">
						<h4><?php echo htmlspecialchars($results['product']->product_name); ?></h4>
						<h5 class="item_price"><?php echo htmlspecialchars($results['product']->product_selling_price); ?> Rs <del><?php echo htmlspecialchars($results['product']->product_mrp); ?> Rs</del></h5>
						<!-- <h5 class="pric1"></h5> -->

						<p class="para"><?php echo htmlspecialchars($results['product']->product_small_desc); ?></p>
						<div class="prdt-info-grid">
							<ul>
								<li>- Brand : Fos Lighting</li>
								<li>- Dimensions : (LXBXH) in cms of...</li>
								<li>- Color : Brown</li>
								<li>- Material : Wood</li>
							</ul>
						</div>
						
						<a href="#" class="add-cart item_add">ADD TO CART</a>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="bottom-prdt">
			<div class="btm-grid-sec">
			<?php 
			$counter = 0;
			foreach ($results['products'] as $product) { 
				if($counter>=5) break;
				?>
				<div class="col-md-2 btm-grid">
					<a href="users.php?action=viewProductDetails&product_id=<?php echo $product->product_id; ?>">
						<img src="<?php echo htmlspecialchars($product->product_product_image_1); ?>" alt="" />
						<h4><?php echo htmlspecialchars($product->product_name); ?></h4>
						<span><?php echo htmlspecialchars($product->product_selling_price); ?> Rs</span>
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
</div>
<!---->
<div class="subscribe">
	<div class="container">
		<h3>Newsletter</h3>
		<form>
			<input type="text" class="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
			<input type="submit" value="Subscribe">
		</form>
	</div>
</div>
<!---->
<div class="footer">
	<div class="container">
		<div class="footer-grids">
			<div class="col-md-3 about-us">
				<h3>About Us</h3>
				<p>Maecenas nec auctor sem. Vivamus porttitor tincidunt elementum nisi a, euismod rhoncus urna. Curabitur scelerisque vulputate arcu eu pulvinar. Fusce vel neque diam</p>
			</div>
			<div class="col-md-3 ftr-grid">
				<h3>Information</h3>
				<ul class="nav-bottom">
					<li><a href="#">Track Order</a></li>
					<li><a href="#">New Products</a></li>
					<li><a href="#">Location</a></li>
					<li><a href="#">Our Stores</a></li>
					<li><a href="#">Best Sellers</a></li>
				</ul>
			</div>
			<div class="col-md-3 ftr-grid">
				<h3>More Info</h3>
				<ul class="nav-bottom">
					<li><a href="login.html">Login</a></li>
					<li><a href="#">FAQ</a></li>
					<li><a href="contact.html">Contact</a></li>
					<li><a href="#">Shipping</a></li>
					<li><a href="#">Membership</a></li>
				</ul>
			</div>
			<div class="col-md-3 ftr-grid">
				<h3>Categories</h3>
				<ul class="nav-bottom">
					<li><a href="#">Car Lights</a></li>
					<li><a href="#">LED Lights</a></li>
					<li><a href="#">Decorates</a></li>
					<li><a href="#">Wall Lights</a></li>
					<li><a href="#">Protectors</a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<div class="copywrite">
	<div class="container">
		<div class="copy">
			<p>© 2015 Lighting. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
		</div>
		<div class="social">
			<a href="#"><i class="facebook"></i></a>
			<a href="#"><i class="twitter"></i></a>
			<a href="#"><i class="dribble"></i></a>
			<a href="#"><i class="google"></i></a>
			<a href="#"><i class="youtube"></i></a>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!---->
</body>

</html>
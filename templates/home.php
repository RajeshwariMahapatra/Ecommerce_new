<?php include 'templates/include/user_header.php' ?>
<!-- //header -->
<!-- banner -->
	<div class="banner">
		<div class="container">
			<div class="banner-info animated wow zoomIn" data-wow-delay=".5s">
				<h3>Free Online Shopping</h3>
				<h4>Up to <span>50% <i>Off/-</i></span></h4>
				<div class="wmuSlider example1">
					<div class="wmuSliderWrapper">
						<article style="position: absolute; width: 100%; opacity: 0;"> 
							<div class="banner-wrap">
								<div class="banner-info1">
									<p>T-Shirts + Formal Pants + Jewellery + Cosmetics</p>
								</div>
							</div>
						</article>
						<article style="position: absolute; width: 100%; opacity: 0;"> 
							<div class="banner-wrap">
								<div class="banner-info1">
									<p>Toys + Furniture + Lighting + Watches</p>
								</div>
							</div>
						</article>
						<article style="position: absolute; width: 100%; opacity: 0;"> 
							<div class="banner-wrap">
								<div class="banner-info1">
									<p>Tops + Books & Media + Sports</p>
								</div>
							</div>
						</article>
					</div>
				</div>
					<script src="js/jquery.wmuSlider.js"></script> 
					<script>
						$('.example1').wmuSlider();         
					</script> 
			</div>
		</div>
	</div>
<!-- //banner -->
<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container"> 
			<div class="banner-bottom-grids">
				<div class="banner-bottom-grid-left animated wow slideInLeft" data-wow-delay=".5s">
					<div class="grid">
						<figure class="effect-julia">
							<img src="templates/images/4.jpg" alt=" " class="img-responsive" />
							<figcaption>
								<h3>Best <span>Store</span><i> in online shopping</i></h3>
								<div>
									<p>Cupidatat non proident, sunt</p>
									<p>Officia deserunt mollit anim</p>
									<p>Laboris nisi ut aliquip consequat</p>
								</div>
							</figcaption>			
						</figure>
					</div>
				</div>
				<div class="banner-bottom-grid-left1 animated wow slideInUp" data-wow-delay=".5s">
					<div class="banner-bottom-grid-left-grid left1-grid grid-left-grid1">
						<div class="banner-bottom-grid-left-grid1">
							<img src="templates/images/1.jpg" alt=" " class="img-responsive" />
						</div>
						<div class="banner-bottom-grid-left1-pos">
							<p>Discount 45%</p>
						</div>
					</div>
					<div class="banner-bottom-grid-left-grid left1-grid grid-left-grid1">
						<div class="banner-bottom-grid-left-grid1">
							<img src="templates/images/2.jpg" alt=" " class="img-responsive" />
						</div>
						<div class="banner-bottom-grid-left1-position">
							<div class="banner-bottom-grid-left1-pos1">
								<p>Latest New Collections</p>
							</div>
						</div>
					</div>
				</div>
				<div class="banner-bottom-grid-right animated wow slideInRight" data-wow-delay=".5s">
					<div class="banner-bottom-grid-left-grid grid-left-grid1">
						<div class="banner-bottom-grid-left-grid1">
							<img src="templates/images/3.jpg" alt=" " class="img-responsive" />
						</div>
						<div class="grid-left-grid1-pos">
							<p>top and classic designs <span>2016 Collection</span></p>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //banner-bottom -->
<!-- collections -->
<div class="new-collections">
    <div class="container">
        <h3 class="animated wow zoomIn" data-wow-delay=".5s">New Collections</h3>
        <p class="est animated wow zoomIn" data-wow-delay=".5s">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <div class="new-collections-grids">
		<?php foreach ( $results['articles'] as $product ) { ?>

                <div class="col-md-3 new-collections-grid">
                    <div class="new-collections-grid1 animated wow slideInUp" data-wow-delay=".5s">
                        <div class="new-collections-grid1-image">
                            <a href="index.php?action=single" class="product-image"><img src="<?php echo $product->product_product_image_1; ?>" alt="<?php echo $product->product_name; ?>" class="img-responsive" /></a>
                            <div class="new-collections-grid1-image-pos">
                                <a href="index.php?action=single">Quick View</a>
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
                            <p><i>$<?php echo $product->product_selling_price; ?></i> <span class="item_price">$<?php echo $product->product_mrp; ?></span><a class="item_add" href="index.php?action=register">add to cart </a></p>
                        </div>
                    </div>
                </div>
				<?php } ?>
        </div>
    </div>
</div>

<!-- //collections -->
<!-- new-timer -->
	<div class="timer">
		<div class="container">
			<div class="timer-grids">
				<div class="col-md-8 timer-grid-left animated wow slideInLeft" data-wow-delay=".5s">
					<h3><a href="index.php?action=products">sunt in culpa qui officia deserunt mollit</a></h3>
					<div class="rating">
						<div class="rating-left">
							<img src="templates/images/2.png" alt=" " class="img-responsive" />
						</div>
						<div class="rating-left">
							<img src="templates/images/2.png" alt=" " class="img-responsive" />
						</div>
						<div class="rating-left">
							<img src="templates/images/2.png" alt=" " class="img-responsive" />
						</div>
						<div class="rating-left">
							<img src="templates/images/2.png" alt=" " class="img-responsive" />
						</div>
						<div class="rating-left">
							<img src="templates/images/1.png" alt=" " class="img-responsive" />
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="new-collections-grid1-left simpleCart_shelfItem timer-grid-left-price">
						<p><i>$580</i> <span class="item_price">$550</span></p>
						<h4>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
							nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit 
							qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui 
							dolorem eum fugiat quo voluptas nulla pariatur.</h4>
						<p><a class="item_add timer_add" href="index.php?action=register">add to cart </a></p>
					</div>
					<div id="counter"> </div>
					<script src="js/jquery.countdown.js"></script>
					<script src="js/script.js"></script>
				</div>
				<div class="col-md-4 timer-grid-right animated wow slideInRight" data-wow-delay=".5s">
					<div class="timer-grid-right1">
						<img src="templates/images/17.jpg" alt=" " class="img-responsive" />
						<div class="timer-grid-right-pos">
							<h4>Special Offer</h4>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //new-timer -->
<!-- collections-bottom -->
	<div class="collections-bottom">
		<div class="container">
			<div class="collections-bottom-grids">
				<div class="collections-bottom-grid animated wow slideInLeft" data-wow-delay=".5s">
					<h3>45% Offer For <span>Women & Children's</span></h3>
				</div>
			</div>
			<div class="newsletter animated wow slideInUp" data-wow-delay=".5s">
				<h3>Newsletter</h3>
				<p>Join us now to get all news and special offers.</p>
				<form>
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
					<input type="email" value="Enter your email address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your email address';}" required="">
					<input type="submit" value="Join Us" >
				</form>
			</div>
		</div>
	</div>
<!-- //collections-bottom -->
<!-- footer -->
<?php include 'templates/include/user_footer.php' ?>
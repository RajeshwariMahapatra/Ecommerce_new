<?php include("include/header.php"); ?>
<div class="product-model">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Products</li>
		</ol>
		<h2>Our Products</h2>
		<div class="col-md-9 product-model-sec">
			<?php
			foreach ($results['products'] as $product) {
			?>
				<a href="single.html">
					<div class="product-grid">
						<div class="more-product"><span> </span></div>
						<div class="product-img b-link-stripe b-animate-go  thickbox">
							<img src=" <?php echo $product->product_product_image_1; ?>" class="img-responsive" alt="">
							<div class="b-wrapper">
								<h4 class="b-animate b-from-left  b-delay03">
									<button><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Quick View</button>
								</h4>
							</div>
						</div>
				</a>
				<div class="product-info simpleCart_shelfItem">
					<div class="product-info-cust prt_name">
						<h4> <?php echo $product->product_name; ?></h4>
						<span class="item_price"> <?php echo $product->product_selling_price; ?></span>
						<div class="ofr">
							<p class="pric1"><del> <?php echo $product->product_mrp; ?></del></p>
							<?php
							// Calculate the discount percentage
							$discountPercentage = 0;
							if ($product->product_mrp > 0) {
								$discountPercentage = (($product->product_mrp - $product->product_selling_price) / $product->product_mrp) * 100;
							}
							?>
							<p class="disc">[<?php echo number_format($discountPercentage, 2); ?>% Off]</p>
						</div>
						<input type="button" class="item_add items" value="ADD">
						<div class="clearfix"> </div>
					</div>

				</div>
		</div>
	<?php
			}
	?>


	</div>
	<div class="rsidebar span_1_of_left">
		<section class="sky-form">
			<div class="product_right">
				<h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Categories</h4>
				<?php foreach ($results['categories'] as $category) : ?>
					<div class="tab">
						<ul class="place">
							<li class="sort"><a href="users.php?action=viewProducts&category_id=<?php echo $category->category_id; ?>"><?php echo htmlspecialchars($category->category_name); ?></a></li>
							<li class="by"><img src="templates/images/do.png" alt=""></li>
							<div class="clearfix"> </div>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>

		</section>

		<section class="sky-form">
			<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>DISCOUNTS</h4>
			<div class="row row1 scroll-pane">
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Upto - 10% (20)</label>
				</div>
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>40% - 50% (5)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>30% - 20% (7)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>10% - 5% (2)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Other(50)</label>
				</div>
			</div>
		</section>

		<section class="sky-form">
			<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Price</h4>
			<ul class="dropdown-menu1">
				<li><a href="">
						<div id="slider-range"></div>
						<input type="text" id="amount" style="border: 0; font-weight: NORMAL;   font-family: 'Dosis-Regular';" />
					</a></li>
			</ul>
		</section>
		<!---->
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
		<script type='text/javascript'>
			//<![CDATA[ 
			$(window).load(function() {
				$("#slider-range").slider({
					range: true,
					min: 0,
					max: 100000,
					values: [500, 100000],
					slide: function(event, ui) {
						$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
					}
				});
				$("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

			}); //]]> 
		</script>
		<!---->


		<section class="sky-form">
			<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Type</h4>
			<div class="row row1 scroll-pane">
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Lights (30)</label>
				</div>
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Diwali Lights (30)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Tube Lights (30)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>LED Lights (30)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Bulbs (30)</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Ceiling Lights (30)</label>
				</div>
			</div>
		</section>
		<section class="sky-form">
			<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Brand</h4>
			<div class="row row1 scroll-pane">
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Everyday</label>
				</div>
				<div class="col col-4">
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Anchor</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Philips</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Wipro</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Havells</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Ferolex</label>
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Gold Medal</label>
				</div>
			</div>
		</section>
	</div>
</div>
</div>
</div>
<!---->
<?php include("include/footer.php"); ?>
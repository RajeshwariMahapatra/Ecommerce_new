<?php include 'templates/include/user_header.php' ?>
<!-- //header -->
<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="index.php?action=home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">Checkout Page</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<!-- checkout -->
<div class="checkout">
	<div class="container">
		<h3 class="animated wow slideInLeft" data-wow-delay=".5s">Your shopping cart contains: <span><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?> Products</span></h3>
		<div class="checkout-right animated wow slideInUp" data-wow-delay=".5s">
			<table class="timetable_sub">
				<thead>
					<tr>
						<th>SL No.</th>
						<th>Product</th>
						<th>Quality</th>
						<th>Product Name</th>
						<th>Service Charges</th>
						<th>Price</th>
						<th>Remove</th>
					</tr>
				</thead>
				<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) : ?>
					<?php foreach ($_SESSION['cart'] as $product) : ?>
						<tr class="rem1">
							<td class="invert"><?php echo $product['productCode'];?></td>
							<td class="invert-image"><a href="index.php?action=single&product_id=<?php echo $product['id']; ?>"><img src="<?php echo $product['image']; ?>" alt=" " class="img-responsive" /></a></td>
							<td class="invert">
								<div class="quantity">
									<div class="quantity-select">
										<form action="index.php?action=updateCart" method="post">
											<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
											<input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1">
											<button type="submit">Update</button>
										</form>
										
									</div>
								</div>
							</td>
							<td class="invert"><?php echo $product['name']; ?></td>
							<td class="invert">0.00</td>
							<td class="invert"><?php echo $product['quantity']; ?> * <?php echo $product['price']; ?></td>
							<td class="invert">
								<div class="rem">
								<form action="index.php?action=removeFromCart" method="post">
											<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
											<button type="submit">Remove</button>
										</form>
								</div>
								<script>
									$(document).ready(function(c) {
										$('.close1').on('click', function(c) {
											$('.rem1').fadeOut('slow', function(c) {
												$('.rem1').remove();
											});
										});
									});
								</script>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<p>Your cart is empty.</p>
				<?php endif; ?>
				<!--quantity-->
				<script>
					$('.value-plus').on('click', function() {
						var divUpd = $(this).parent().find('.value'),
							newVal = parseInt(divUpd.text(), 10) + 1;
						divUpd.text(newVal);
					});

					$('.value-minus').on('click', function() {
						var divUpd = $(this).parent().find('.value'),
							newVal = parseInt(divUpd.text(), 10) - 1;
						if (newVal >= 1) divUpd.text(newVal);
					});
				</script>
				<!--quantity-->
			</table>
		</div>
		<div class="checkout-left">
			<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
				<h4>Continue to basket</h4>
				<ul>
					<li>Total <i>al</i> <span>₹<?php echo calculateTotal(); ?></span></li>
					<li>Total Service Charges <i>-</i> <span>0.00</span></li>
					<li>Total <i>-</i> <span>₹<?php echo calculateGrandTotal(); ?></span></li>
				</ul>
			</div>
			<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
				<a href="index.php?action=single"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!-- //checkout -->
<!-- footer -->
<?php include 'templates/include/user_footer.php' ?>
<?php include("include/header.php"); ?>

<!-- check out -->
<div class="container">
	<div class="check-sec">
		<div class="col-md-3 cart-total">
			<a class="continue" href="product.html">Continue to basket</a>
			<div class="price-details">
				<h3>Price Details</h3>
				<span>Total</span>
				<span class="simpleCart_total"></span>
				<span>Discount</span>
				<span class="total1">10%(Festival Offer)</span>
				<span>Delivery Charges</span>
				<span class="total1">150.00</span>
				<div class="clearfix"></div>
			</div>
			<ul class="total_price">
				<li class="last_price">
					<h4>TOTAL</h4>
				</li>
				<li class="last_price"><span>6150.00</span></li>
			</ul>
			<div class="clearfix"></div>
			<div class="clearfix"></div>
			<a class="order" href="#">Place Order</a>
			<div class="total-item">
				<h3>OPTIONS</h3>
				<h4>COUPONS</h4>
				<a class="cpns" href="#">Apply Coupons</a>
			</div>
		</div>
		<div class="col-md-9 cart-items">
			<h1>My Shopping Bag (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</h1>
			<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) : ?>
				<?php foreach ($_SESSION['cart'] as $product) : ?>
					<div class="cart-header">
						<div class="cart-sec simpleCart_shelfItem">
							<div class="cart-item cyc">
								<img src="<?php echo $product['image'];?>" class="img-responsive" alt="" />
							</div>
							<div class="cart-item-info">
								<h3>
									<a href="users.php?action=viewProductDetails&product_id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
									<span>Model No: <?php echo $product['productCode'];?></span>
								</h3>
								<ul class="qty">
									<li>
										<p>Price : <?php echo $product['price']; ?></p>
									</li>
									<li>
										<p>Qty : <?php echo $product['quantity']; ?></p>
									</li>
								</ul>
								<div class="delivery">
									<p>Service Charges : Rs.100.00</p>
									<span>Delivered in 2-3 business days</span>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="clearfix"></div>
							<form action="users.php?action=updateCart" method="post">
								<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
								<input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1">
								<button type="submit">Update</button>
							</form>
							<form action="users.php?action=removeFromCart" method="post">
								<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
								<button type="submit">Remove</button>
							</form>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<p>Your cart is empty.</p>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- //check out -->

<?php include("include/footer.php"); ?>
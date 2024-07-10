<?php include("templates/web/include/header.php"); ?>

<div class="product">
    <div class="container">
        <div class="product-price1">
            <div class="top-sing row">
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
                    <div class="single-para">
                        <h4><?php echo htmlspecialchars($results['product']->product_name); ?></h4>
                        <div class="pricing">
                            <?php
                            $selling_price = htmlspecialchars($results['product']->product_selling_price);
                            $mrp = htmlspecialchars($results['product']->product_mrp);
                            $discount = round((($mrp - $selling_price) / $mrp) * 100);
                            ?>
                            <span class="badge bg-danger">-<?php echo $discount; ?>%</span>
                            <h5 class="item_price d-inline"><sup>₹</sup><?php echo $selling_price; ?></h5>
                            <small class="text-muted"><del><?php echo $mrp; ?> Rs</del></small>
                        </div>
                        <p ><?php echo htmlspecialchars($results['product']->product_small_desc); ?></p>
                        <div class="prdt-info-grid">
                            <ul>
                                <p>Brand: <?php echo htmlspecialchars($results['brand']->brand_name); ?></p>
                            </ul>
                        </div>
                        <form action="users.php?action=addToCart" method="post">
							<!-- <input type="hidden" name="action" value="add"> -->
							<input type="hidden" name="product_id" value="<?php echo htmlspecialchars($results['product']->product_id); ?>">
							<input type="hidden" name="product_name" value="<?php echo htmlspecialchars($results['product']->product_name); ?>">
							<input type="hidden" name="product_selling_price" value="<?php echo htmlspecialchars($results['product']->product_selling_price); ?>">
							<input type="number" class="item_quantity" name="quantity" value="1" min="1">
							<button type="submit" class="item_add items">Add to Cart</button>
						</form>
                    </div>
                </div>
            </div>
        </div>

        <!-- About This Item Section -->
        <div class="about-item mt-5">
            <h3>About This Item</h3>
            <p><?php echo htmlspecialchars($results['product']->product_desc); ?></p>
			
        </div>
        <!-- End of About This Item Section -->

        <!-- Additional Product Information Section -->
        <div class="additional-info mt-5">
            <h3>Additional Information</h3>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Stock:</strong> <?php echo htmlspecialchars($results['product']->product_stock); ?></li>
                        <li class="list-group-item"><strong>Shipping Time Estimate:</strong> <?php echo htmlspecialchars($results['product']->product_shipping_time_est); ?></li>
                        <li class="list-group-item"><strong>Breadth:</strong> <?php echo htmlspecialchars($results['product']->product_breadth); ?></li>
                        <li class="list-group-item"><strong>Volume:</strong> <?php echo htmlspecialchars($results['product']->product_volume); ?></li>
                        <li class="list-group-item"><strong>Height:</strong> <?php echo htmlspecialchars($results['product']->product_height); ?></li>
                        <li class="list-group-item"><strong>Weight:</strong> <?php echo htmlspecialchars($results['product']->product_weight); ?></li>
                        <li class="list-group-item"><strong>Tags:</strong> <?php echo htmlspecialchars($results['product']->product_tags); ?></li>
                        <li class="list-group-item"><strong>Tax:</strong> <?php echo htmlspecialchars($results['product']->product_tax); ?></li>
                        <li class="list-group-item"><strong>HSN Code:</strong> <?php echo htmlspecialchars($results['product']->product_hsn_code); ?></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Certification:</strong> <?php echo htmlspecialchars($results['product']->product_certification); ?></li>
                        <li class="list-group-item"><strong>Barcode:</strong> <?php echo htmlspecialchars($results['product']->product_barcode); ?></li>
                        <li class="list-group-item"><strong>SKU:</strong> <?php echo htmlspecialchars($results['product']->product_sku); ?></li>
                        <li class="list-group-item"><strong>Product Code:</strong> <?php echo htmlspecialchars($results['product']->product_code); ?></li>
                        <li class="list-group-item"><strong>Warranty:</strong> <?php echo htmlspecialchars($results['product']->product_warranty); ?></li>
                        <li class="list-group-item"><strong>Guarantee:</strong> <?php echo htmlspecialchars($results['product']->product_guarantee); ?></li>
                        <li class="list-group-item"><strong>Features:</strong> <?php echo htmlspecialchars($results['product']->product_features); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End of Additional Product Information Section -->

        <div class="bottom-prdt mt-5">
            <h3>Related Products</h3>
            <div class="row btm-grid-sec">
                <?php 
                $counter = 0;
                foreach ($results['products'] as $product) { 
                    if ($counter >= 5) break;
                    ?>
                    <div class="col-md-2 btm-grid">
                        <div class="card mb-3">
                            <a href="users.php?action=viewProductDetails&product_id=<?php echo $product->product_id; ?>">
                                <img src="<?php echo htmlspecialchars($product->product_product_image_1); ?>" class="card-img-top" alt="" />
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product->product_name); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($product->product_selling_price); ?> Rs</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php 
                    $counter++;
                } 
                ?>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
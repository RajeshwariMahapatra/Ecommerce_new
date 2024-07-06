<?php include 'templates/include/user_header.php' ?>
<!-- //header -->
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.php?action=home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Single Page</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- single -->
<div class="single">
    <div class="container">
        <div class="col-md-12 single-right">
            <div class="col-md-5 single-right-left animated wow slideInUp" data-wow-delay=".5s">
                <div class="flexslider">
                    <ul class="slides">
                        <li data-thumb="<?php echo $product->product_product_image_1; ?>">
                            <div class="thumb-image"> <img src="<?php echo $product->product_product_image_1; ?>" data-imagezoom="true" class="img-responsive"> </div>
                        </li>
                        <li data-thumb="<?php echo $product->product_product_image_2; ?>">
                            <div class="thumb-image"> <img src="<?php echo $product->product_product_image_2; ?>" data-imagezoom="true" class="img-responsive"> </div>
                        </li>
                        <li data-thumb="<?php echo $product->product_product_image_3; ?>">
                            <div class="thumb-image"> <img src="<?php echo $product->product_product_image_3; ?>" data-imagezoom="true" class="img-responsive"> </div>
                        </li>
                    </ul>
                </div>
                <!-- flexslider -->
                <script defer src="templates/js/jquery.flexslider.js"></script>
                <link rel="stylesheet" href="templates/css/flexslider.css" type="text/css" media="screen" />
                <script>
                    $(window).load(function() {
                        $('.flexslider').flexslider({
                            animation: "slide",
                            controlNav: "thumbnails"
                        });
                    });
                </script>
                <!-- flexslider -->
            </div>
            <div class="col-md-7 single-right-left simpleCart_shelfItem animated wow slideInRight" data-wow-delay=".5s">
                <h3><?php echo $product->product_name; ?></h3>
                <h4><i>$<?php echo $product->product_selling_price; ?></i> <span class="item_price">$<?php echo $product->product_mrp; ?></span></h4>
                <div class="rating1">
                    <span class="starRating">
                        <input id="rating5" type="radio" name="rating" value="5">
                        <label for="rating5">5</label>
                        <input id="rating4" type="radio" name="rating" value="4">
                        <label for="rating4">4</label>
                        <input id="rating3" type="radio" name="rating" value="3" checked>
                        <label for="rating3">3</label>
                        <input id="rating2" type="radio" name="rating" value="2">
                        <label for="rating2">2</label>
                        <input id="rating1" type="radio" name="rating" value="1">
                        <label for="rating1">1</label>
                    </span>
                </div>
                <div class="description">
                    <h5><i>Description</i></h5>
                    <p><?php echo $product->product_small_desc; ?></p>
                </div>
                <div class="occasional">
                    <?php
                    $product_features_string = $product->product_features;
                    $product_features_array = explode(' ', $product_features_string);
                    ?>
                    <h5>Features :</h5>
                    <?php foreach ($product_features_array as $index => $feature): ?>
                    <div class="colr <?php echo $index === 0 ? 'ert' : ''; ?>">
                        <label class="radio">
                            <input type="radio" name="radio" <?php echo $index === 0 ? 'checked' : ''; ?>>
                            <i></i><?php echo htmlspecialchars(trim($feature)); ?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                    <div class="clearfix"> </div>
                </div>
                <div class="description">
                    <h5>Estimated delivery by: Friday, July 2</h5>
                </div>
                <div class="occasion-cart">
                    <a class="item_add" href="#">add to cart </a>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="bootstrap-tab animated wow slideInUp" data-wow-delay=".5s">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Description</a></li>
                    <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Reviews(2)</a></li>
                    <li role="presentation" class="dropdown">
                        <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Information <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                            <li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">Product Dimensions</a></li>
                            <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">Warranty Terms</a></li>
                        </ul>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
                        <h5>Product Brief Description</h5>
                        <p><?php echo $product->product_desc; ?></p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
                        <div class="bootstrap-tab-text-grids">
                            <div class="bootstrap-tab-text-grid">
                                <div class="bootstrap-tab-text-grid-left">
                                    <img src="templates/images/4.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="bootstrap-tab-text-grid-right">
                                    <ul>
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-share" aria-hidden="true"></span>Reply</a></li>
                                    </ul>
                                    <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis 
                                        suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem 
                                        vel eum iure reprehenderit.</p>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="bootstrap-tab-text-grid">
                                <div class="bootstrap-tab-text-grid-left">
                                    <img src="templates/images/5.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="bootstrap-tab-text-grid-right">
                                    <ul>
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-share" aria-hidden="true"></span>Reply</a></li>
                                    </ul>
                                    <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis 
                                        suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem 
                                        vel eum iure reprehenderit.</p>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="add-review">
                                <h4>add a review</h4>
                                <form>
                                    <input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
                                    <input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                                    <input type="text" value="Subject" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}" required="">
                                    <textarea type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
                                    <input type="submit" value="Send">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown1" aria-labelledby="dropdown1-tab">
                        <p>Height: <?php echo $product->product_height; ?> cm<br>Breadth: <?php echo $product->product_breadth; ?> cm<br>Weight: <?php echo $product->product_weight; ?> g<br>Volume: <?php echo $product->product_volume; ?> L</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown2" aria-labelledby="dropdown2-tab">
                        <p>Warranty terms: <?php echo $product->product_warranty; ?></p>
                        <p>Guarantee terms: <?php echo $product->product_guarantee; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //single -->
<!-- single-related-products -->
<div class="single-related-products">
    <div class="container">
        <h3 class="animated wow slideInUp" data-wow-delay=".5s">Related Products</h3>
        <p class="est animated wow slideInUp" data-wow-delay=".5s">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
            deserunt mollit anim id est laborum.</p>
        <div class="new-collections-grids">
            <?php foreach ($results['singles'] as $product) { ?>
            <div class="col-md-3 new-collections-grid">
                <div class="new-collections-grid1 animated wow slideInUp" data-wow-delay=".5s">
                    <div class="new-collections-grid1-image">
                        <a href="index.php?action=single&product_id=<?php echo $product->product_id; ?>" class="product-image"><img src="<?php echo $product->product_product_image_1; ?>" alt="<?php echo $product->product_name; ?>" class="img-responsive" /></a>
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
							<p><i>$<?php echo $product->product_selling_price; ?></i> <span class="item_price">$<?php echo $product->product_mrp; ?>
									<div class="occasion-cart">
										<a class="item_add" href="index.php?action=register">add to cart </a>
									</div>
						</div>
                </div>
            </div>
            <?php } ?>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //single-related-products -->
<!-- footer -->
<?php include 'templates/include/user_footer.php' ?>

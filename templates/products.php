<?php include 'templates/include/user_header.php' ?>
<!-- //header -->
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.php?action=home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Products</li>
        </ol>
    </div>
</div>
<div class="products">
    <div class="container">
        <div class="col-md-4 products-left">
            <div class="categories animated wow slideInUp" data-wow-delay=".5s">
                <h3>Categories</h3>
                <ul class="cate">
                    <?php foreach ($results['categories'] as $category) { ?>
                        <li><a href="index.php?action=products&category_id=<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></a> <span></span></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="new-products animated wow slideInUp" data-wow-delay=".5s">
                <h3>New Products</h3>
                <div class="new-products-grids">
                    <?php foreach ($results['products'] as $product) { ?>
                        <div class="new-products-grid">
                            <div class="new-products-grid-left">
                                <a href="index.php?action=single&product_id=<?php echo $product->product_id; ?>"><img src="<?php echo $product->product_product_image_1; ?>" alt="<?php echo $product->product_name; ?>" class="img-responsive" /></a>
                            </div>
                            <div class="new-products-grid-right">
                                <h4><a href="index.php?action=single&product_id=<?php echo $product->product_id; ?>"><?php echo $product->product_name; ?></a></h4>
                                <div class="rating">
                                    <div class="rating-left">
                                        <img src="templates/images/2.png" alt=" " class="img-responsive">
                                    </div>
                                    <div class="rating-left">
                                        <img src="templates/images/2.png" alt=" " class="img-responsive">
                                    </div>
                                    <div class="rating-left">
                                        <img src="templates/images/2.png" alt=" " class="img-responsive">
                                    </div>
                                    <div class="rating-left">
                                        <img src="templates/images/1.png" alt=" " class="img-responsive">
                                    </div>
                                    <div class="rating-left">
                                        <img src="templates/images/1.png" alt=" " class="img-responsive">
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="simpleCart_shelfItem new-products-grid-right-add-cart">
                                    <p> <span class="item_price"><?php echo $product->product_mrp; ?></span><a class="item_add" href="#">add to cart </a></p>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="men-position animated wow slideInUp" data-wow-delay=".5s">
                <a href="index.php?action=single"><img src="templates/images/27.jpg" alt=" " class="img-responsive" /></a>
                <div class="men-position-pos">
                    <h4>Summer collection</h4>
                    <h5><span>55%</span> Flat Discount</h5>
                </div>
            </div>
        </div>
        <div class="col-md-8 products-right">
            <div class="products-right-grid">
                <div class="products-right-grids animated wow slideInRight" data-wow-delay=".5s">
                    <div class="sorting">
                        <select id="country" onchange="change_country(this.value)" class="frm-field required sect">
                            <option value="null">Default sorting</option>
                            <option value="null">Sort by popularity</option>
                            <option value="null">Sort by average rating</option>
                            <option value="null">Sort by price</option>
                        </select>
                    </div>
                    <div class="sorting-left">
                        <select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
                            <option value="null">Item on page 9</option>
                            <option value="null">Item on page 18</option>
                            <option value="null">Item on page 32</option>
                            <option value="null">All</option>
                        </select>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="products-right-grids-position animated wow slideInRight" data-wow-delay=".5s">
                    <img src="templates/images/18.jpg" alt=" " class="img-responsive" />
                    <div class="products-right-grids-position1">
                        <h4>2016 New Collection</h4>
                        <p>Temporibus autem quibusdam et aut officiis debitis aut rerum 
                            necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae 
                            non recusandae.</p>
                    </div>
                </div>
            </div>
            <div class="products-right-grids-bottom">
                <div class="new-collections-grids">
                    <?php foreach ($results['products'] as $product) { ?>
                        <div class="col-md-6 new-collections-grid">
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
                                    <p><i>$<?php echo $product->product_selling_price; ?></i> <span class="item_price">$<?php echo $product->product_mrp; ?><a class="item_add" href="index.php?action=register">add to cart </a></span></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="clearfix"> </div>
            </div>
            <nav class="numbering animated wow slideInRight" data-wow-delay=".5s">
                <ul class="pagination paging">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- footer -->
<?php include 'templates/include/user_footer.php' ?>

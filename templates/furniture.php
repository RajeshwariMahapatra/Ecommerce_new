<?php include 'templates/include/user_header.php'; ?>
<!-- //header -->
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.php?action=home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Furniture</li>
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
                        <li><a href="index.php?action=products&category_id=<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></a></li>
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
                                    <div class="rating-left"><img src="templates/images/2.png" alt=" " class="img-responsive"></div>
                                    <div class="rating-left"><img src="templates/images/2.png" alt=" " class="img-responsive"></div>
                                    <div class="rating-left"><img src="templates/images/2.png" alt=" " class="img-responsive"></div>
                                    <div class="rating-left"><img src="templates/images/1.png" alt=" " class="img-responsive"></div>
                                    <div class="rating-left"><img src="templates/images/1.png" alt=" " class="img-responsive"></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="simpleCart_shelfItem new-products-grid-right-add-cart">
                                    <p> <span class="item_price"><?php echo $product->product_mrp; ?></span>

                                    <form action="index.php?action=addToCart" method="post">
                                        <!-- <input type="hidden" name="action" value="add"> -->
                                        <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo $product->product_name; ?>">
                                        <input type="hidden" name="product_selling_price" value="<?php echo $product->product_selling_price; ?>">
                                        <input type="number" class="item_quantity" name="quantity" value="1" min="1">
                                        <button type="submit" class="item_add">Add to Cart</button>
                                    </form>
                                    </p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-8 products-right">
            <div class="products-right-grid">
                <div class="products-right-grids animated wow slideInRight" data-wow-delay=".5s">
                    <div class="sorting">
                        <label for="sort">Sort by:</label>
                        <select id="sort" name="sort" onchange="sortProducts()" class="frm-field required sect">
                            <option value="default" <?php echo !isset($_GET['sort']) || $_GET['sort'] == 'default' ? 'selected' : ''; ?>>Default sorting</option>
                            <option value="price_asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : ''; ?>>Sort by price: Low to High</option>
                            <option value="price_desc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : ''; ?>>Sort by price: High to Low</option>
                            <option value="newest" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'newest' ? 'selected' : ''; ?>>Sort by newest arrivals</option>
                            <option value="oldest" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'oldest' ? 'selected' : ''; ?>>Sort by oldest arrivals</option>
                            <option value="name_asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'name_asc' ? 'selected' : ''; ?>>Sort by name: A to Z</option>
                            <option value="name_desc" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'name_desc' ? 'selected' : ''; ?>>Sort by name: Z to A</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="products-right-grids-position animated wow slideInRight" data-wow-delay=".5s">
                    <img src="templates/images/28.jpg" alt=" " class="img-responsive" />
                    <div class="products-right-grids-position1">
                        <h4>2024 New Collection</h4>
                        <p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.</p>
                    </div>
                </div>
            </div>
            <div class="products-right-grids-bottom">
                <?php foreach ($results['products'] as $product) { ?>
                    <div class="col-md-6 new-collections-grid">
                        <div class="new-collections-grid1 animated wow slideInUp" data-wow-delay=".5s">
                            <div class="new-collections-grid1-image">
                                <a href="index.php?action=single&product_id=<?php echo $product->product_id; ?>" class="product-image"><img src="<?php echo $product->product_product_image_1; ?>" alt="<?php echo $product->product_name; ?>" class="img-responsive" /></a>
                                <div class="new-collections-grid1-image-pos">
                                    <a href="index.php?action=single&product_id=<?php echo $product->product_id; ?>">Quick View</a>
                                </div>
                                <div class="new-collections-grid1-right">
                                    <div class="rating">
                                        <div class="rating-left"><img src="templates/images/2.png" alt=" " class="img-responsive"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <h4><a href="index.php?action=single"><?php echo $product->product_name; ?></a></h4>
                            <p><?php echo $product->product_small_desc; ?></p>
                            <div class="new-collections-grid1-left simpleCart_shelfItem">
                                <p><i>$<?php echo $product->product_selling_price; ?></i> <span class="item_price">$<?php echo $product->product_mrp; ?></span>
                                <form action="index.php?action=addToCart" method="post">
                                    <!-- <input type="hidden" name="action" value="add"> -->
                                    <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $product->product_name; ?>">
                                    <input type="hidden" name="product_selling_price" value="<?php echo $product->product_selling_price; ?>">
                                    <input type="number" class="item_quantity" name="quantity" value="1" min="1">
                                    <button type="submit" class="item_add">Add to Cart</button>
                                </form>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
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
        <div class="clearfix"></div>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- footer -->
<?php include 'templates/include/user_footer.php'; ?>


<script>
    function sortProducts() {
        const sort = document.getElementById('sort').value;
        const searchParams = new URLSearchParams(window.location.search);
        const search = searchParams.get('search') || '';
        window.location.href = 'index.php?action=furniture&search=' + search + '&sort=' + sort;
    }
</script>
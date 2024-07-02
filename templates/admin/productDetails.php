<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- /.container-fluid -->
<div class="container">
    <h2>Product Details</h2>
    <div class="panel panel-widget">
        <!-- <div class="panel-title">
            Product Details
        </div> -->
        <?php if (isset($product)) : ?>
            <div class="panel-body">

                <div class="form-group">
                    <label for="productCategory" style="font-weight: bold;">Product Category</label>
                    <p id="productCategory" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->category_name); ?></p>
                </div>
                <div class="form-group">
                    <label for="brand" style="font-weight: bold;">Brand</label>
                    <p id="brand" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->brand_name); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_name" style="font-weight: bold;">Product Name</label>
                    <p id="product_name" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_name); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_desc" style="font-weight: bold;">Product Description</label>
                    <p id="product_desc" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_desc); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_small_desc" style="font-weight: bold;">Small Description</label>
                    <p id="product_small_desc" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_small_desc); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_mrp" style="font-weight: bold;">Maximum Retail Price (MRP)</label>
                    <p id="product_mrp" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_mrp); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_selling_price" style="font-weight: bold;">Selling Price</label>
                    <p id="product_selling_price" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_selling_price); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_product_image_1" style="font-weight: bold;">Product Image 1</label>
                    <p id="product_product_image_1" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_product_image_1); ?></p>
                    <?php if (!empty($results['product']->product_product_image_1)) { ?>
                        <img src="<?php echo htmlspecialchars($results['product']->product_product_image_1); ?>" alt="Product Image 1" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                    <?php } else { ?>
                        <p>No Image Available</p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="product_product_image_2" style="font-weight: bold;">Product Image 2</label>
                    <p id="product_product_image_2" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_product_image_2); ?></p>
                    <?php if (!empty($results['product']->product_product_image_2)) { ?>
                        <img src="<?php echo htmlspecialchars($results['product']->product_product_image_2); ?>" alt="Product Image 2" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                    <?php } else { ?>
                        <p>No Image Available</p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="product_product_image_3" style="font-weight: bold;">Product Image 3</label>
                    <p id="product_product_image_3" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_product_image_3); ?></p>
                    <?php if (!empty($results['product']->product_product_image_3)) { ?>
                        <img src="<?php echo htmlspecialchars($results['product']->product_product_image_3); ?>" alt="Product Image 3" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                    <?php } else { ?>
                        <p>No Image Available</p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="product_stock" style="font-weight: bold;">Product Stock</label>
                    <p id="product_stock" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_stock); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_shipping_time_est" style="font-weight: bold;">Shipping Time Estimate (days)</label>
                    <p id="product_shipping_time_est" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_shipping_time_est); ?></p>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="product_breadth" style="font-weight: bold;">Breadth (cm)</label>
                        <p id="product_breadth" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_breadth); ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="product_volume" style="font-weight: bold;">Volume (cm³)</label>
                        <p id="product_volume" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_volume); ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="product_height" style="font-weight: bold;">Height (cm)</label>
                        <p id="product_height" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_height); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_weight" style="font-weight: bold;">Weight (kg)</label>
                    <p id="product_weight" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_weight); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_tags" style="font-weight: bold;">Product Tags</label>
                    <p id="product_tags" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_tags); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_tax" style="font-weight: bold;">Product Tax (%)</label>
                    <p id="product_tax" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_tax); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_hsn_code" style="font-weight: bold;">HSN Code</label>
                    <p id="product_hsn_code" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_hsn_code); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_certification" style="font-weight: bold;">Certification</label>
                    <p id="product_certification" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_certification); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_barcode" style="font-weight: bold;">Barcode</label>
                    <p id="product_barcode" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_barcode); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_sku" style="font-weight: bold;">SKU</label>
                    <p id="product_sku" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_sku); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_code" style="font-weight: bold;">Product Code</label>
                    <p id="product_code" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_code); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_warranty" style="font-weight: bold;">Warranty</label>
                    <p id="product_warranty" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_warranty); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_guarantee" style="font-weight: bold;">Guarantee</label>
                    <p id="product_guarantee" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_guarantee); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_offer_code" style="font-weight: bold;">Offer Code</label>
                    <p id="product_offer_code" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_offer_code); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_features" style="font-weight: bold;">Product Features</label>
                    <p id="product_features" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_features); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_created_on" style="font-weight: bold;">Created On</label>
                    <p id="product_created_on" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_created_on); ?></p>
                </div>
                <div class="form-group">
                    <label for="product_updated_on" style="font-weight: bold;">Updated On</label>
                    <p id="product_updated_on" style="font-size: 0.9em; color: #555;"><?php echo htmlspecialchars($results['product']->product_updated_on); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <button class="btn btn-primary" onclick="window.history.back();">Back</button>
    </div>
</div>


<!-- /.container-fluid -->

<?php include 'templates/admin/include-admin/footer.php'; ?>
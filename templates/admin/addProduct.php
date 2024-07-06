<?php include 'templates/admin/include-admin/admin-header.php'; ?>



<!-- /.container-fluid -->
<div class="container mt-4">
    <div class="card shadow mb-4">
        <!-- Card Header - Form Title -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
        </div>

        <!-- Display Error Message -->
        <?php if (isset($errorcode) && $errorcode != 200) : ?>
            <div class="alert alert-danger">
                <ul>
                    <li><?php echo $errorstatus; ?></li>
                </ul>
            </div>
        <?php endif; ?>
        <!-- Card Body - Form Content -->
        <div class="card-body">
            <form action="admin.php?action=<?php echo $results['formAction'] ?>" method="post" enctype="multipart/form-data" validate="validate">
                <?php if (!empty($results['product']->product_id)) { ?>
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($results['product']->product_id) ?>" />
                <?php } ?>

                <!-- Product Name -->
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" value="<?php echo htmlspecialchars($results['product']->product_name) ?>" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="product_desc">Description:</label>
                    <textarea class="form-control" id="product_desc" name="product_desc" placeholder="Enter product description" required><?php echo htmlspecialchars($results['product']->product_desc) ?></textarea>
                </div>

                <!-- Short Description -->
                <div class="form-group">
                    <label for="product_desc">Small Description:</label>
                    <textarea class="form-control" id="product_small_desc" name="product_small_desc" placeholder="Enter small description" required><?php echo htmlspecialchars($results['product']->product_small_desc) ?></textarea>
                </div>
                <!-- Stock -->
                <div class="form-group">
                    <label for="product_stock">Stock:</label>
                    <input type="number" class="form-control" id="product_stock" name="product_stock" value="<?php echo htmlspecialchars($results['product']->product_stock) ?>" required>
                </div>

                <!-- Categories -->
                <div class="card shadow mb-4">
                    <a href="#collapseCategories" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCategories">
                        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                    </a>
                    <div class="collapse show" id="collapseCategories">
                        <div class="card-body">
                            <!-- Product Category -->
                            <div class="form-group">
                                <label for="product_category_id">Product Category:</label>
                                <select name="product_category_id" id="product_category_id" class="form-control" required>
                                    <?php foreach ($results['categories'] as $category) { ?>
                                        <option value="<?php echo htmlspecialchars($category->category_id); ?>" <?php echo ($category->category_id == $results['product']->product_category_id) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($category->category_name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Product Brand -->
                            <div class="form-group">
                                <label for="product_brand_id">Product Brand:</label>
                                <select name="product_brand_id" id="product_brand_id" class="form-control" required>
                                    <?php foreach ($results['brands'] as $brand) { ?>
                                        <option value="<?php echo htmlspecialchars($brand->brand_id); ?>" <?php echo ($brand->brand_id == $results['product']->product_brand_id) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($brand->brand_name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="card shadow mb-4">
                    <a href="#collapsePricing" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapsePricing">
                        <h6 class="m-0 font-weight-bold text-primary">Pricing</h6>
                    </a>
                    <div class="collapse" id="collapsePricing">
                        <div class="card-body">
                            <!-- Product MRP -->
                            <div class="form-group">
                                <label for="product_mrp">Product MRP:</label>
                                <input type="text" class="form-control" id="product_mrp" name="product_mrp" value="<?php echo htmlspecialchars($results['product']->product_mrp) ?>" required>
                            </div>

                            <!-- Product Selling Price -->
                            <div class="form-group">
                                <label for="product_selling_price">Product Selling Price:</label>
                                <input type="text" class="form-control" id="product_selling_price" name="product_selling_price" value="<?php echo htmlspecialchars($results['product']->product_selling_price) ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="card shadow mb-4">
                    <a href="#collapseImages" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseImages">
                        <h6 class="m-0 font-weight-bold text-primary">Images</h6>
                    </a>
                    <div class="collapse" id="collapseImages">
                        <div class="card-body">
                            <!-- Product Images -->
                            <?php for ($i = 1; $i <= 3; $i++) : ?>
                                <div class="form-group">
                                    <label for="product_product_image_<?php echo $i; ?>">Product Image <?php echo $i; ?>:</label>
                                    <?php if ($results['product'] && $imagePath = $results['product']->{"product_product_image_$i"}) : ?>
                                        <div>
                                            <img id="productImage<?php echo $i; ?>" src="<?php echo htmlspecialchars($imagePath); ?>" alt="Product Image <?php echo $i; ?>" style="max-width: 200px; max-height: 200px;" />
                                        </div>

                                    <?php endif; ?>
                                    <input type="file" class="form-control-file" id="product_product_image_<?php echo $i; ?>" name="product_product_image_<?php echo $i; ?>">
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <!-- Dimensions -->
                <div class="card shadow mb-4">
                    <a href="#collapseDimensions" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseDimensions">
                        <h6 class="m-0 font-weight-bold text-primary">Dimensions</h6>
                    </a>
                    <div class="collapse" id="collapseDimensions">
                        <div class="card-body">
                            <!-- Product Dimensions -->
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="product_breadth">Breadth (cm):</label>
                                    <input type="text" class="form-control" id="product_breadth" name="product_breadth" value="<?php echo htmlspecialchars($results['product']->product_breadth) ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="product_volume">Volume (cm³):</label>
                                    <input type="text" class="form-control" id="product_volume" name="product_volume" value="<?php echo htmlspecialchars($results['product']->product_volume) ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="product_height">Height (cm):</label>
                                    <input type="text" class="form-control" id="product_height" name="product_height" value="<?php echo htmlspecialchars($results['product']->product_height) ?>">
                                </div>
                            </div>

                            <!-- Product Weight -->
                            <div class="form-group">
                                <label for="product_weight">Weight (kg):</label>
                                <input type="text" class="form-control" id="product_weight" name="product_weight" value="<?php echo htmlspecialchars($results['product']->product_weight) ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Details -->
                <div class="card shadow mb-4">
                    <a href="#collapseDetails" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseDetails">
                        <h6 class="m-0 font-weight-bold text-primary">Additional Details</h6>
                    </a>
                    <div class="collapse" id="collapseDetails">
                        <div class="card-body">
                            <!-- Product Tags -->
                            <div class="form-group">
                                <label for="product_tags">Product Tags:</label>
                                <input type="text" class="form-control" id="product_tags" name="product_tags" value="<?php echo htmlspecialchars($results['product']->product_tags) ?>">
                            </div>

                            <!-- Product Shipping Time -->
                            <div class="form-group">
                                <label for="product_tags">Product Estimated Shipping Time(EST) (In Days):</label>
                                <input type="text" class="form-control" id="product_shipping_time_est" name="product_shipping_time_est" value="<?php echo htmlspecialchars($results['product']->product_shipping_time_est) ?>" required>
                            </div>

                            <!-- Product Tax -->
                            <div class="form-group">
                                <label for="product_tax">Product Tax (%):</label>
                                <input type="number" class="form-control" id="product_tax" name="product_tax" value="<?php echo htmlspecialchars($results['product']->product_tax) ?>" required>
                            </div>

                            <!-- HSN Code -->
                            <div class="form-group">
                                <label for="product_hsn_code">HSN Code:</label>
                                <input type="text" class="form-control" id="product_hsn_code" name="product_hsn_code" value="<?php echo htmlspecialchars($results['product']->product_hsn_code) ?>" required>
                            </div>

                            <!-- Certification -->
                            <div class="form-group">
                                <label for="product_certification">Certification:</label>
                                <textarea class="form-control" id="product_certification" name="product_certification" rows="2"><?php echo htmlspecialchars($results['product']->product_certification) ?></textarea>
                            </div>

                            <!-- Barcode -->
                            <div class="form-group">
                                <label for="product_barcode">Barcode:</label>
                                <input type="text" class="form-control" id="product_barcode" name="product_barcode" value="<?php echo htmlspecialchars($results['product']->product_barcode) ?>">
                            </div>

                            <!-- SKU -->
                            <div class="form-group">
                                <label for="product_sku">SKU:</label>
                                <input type="text" class="form-control" id="product_sku" name="product_sku" value="<?php echo htmlspecialchars($results['product']->product_sku) ?>">
                            </div>

                            <!-- Product Code -->
                            <div class="form-group">
                                <label for="product_code">Product Code:</label>
                                <input type="text" class="form-control" id="product_code" name="product_code" value="<?php echo htmlspecialchars($results['product']->product_code) ?>">
                            </div>

                            <!-- Warranty -->
                            <div class="form-group">
                                <label for="product_warranty">Warranty:</label>
                                <textarea class="form-control" id="product_warranty" name="product_warranty" rows="2"><?php echo htmlspecialchars($results['product']->product_warranty) ?></textarea>
                            </div>

                            <!-- Guarantee -->
                            <div class="form-group">
                                <label for="product_guarantee">Guarantee:</label>
                                <textarea class="form-control" id="product_guarantee" name="product_guarantee" rows="2"><?php echo htmlspecialchars($results['product']->product_guarantee) ?></textarea>
                            </div>

                            <!-- Offer Code -->
                            <div class="form-group">
                                <label for="product_offer_code">Offer Code:</label>
                                <input type="text" class="form-control" id="product_offer_code" name="product_offer_code" value="<?php echo htmlspecialchars($results['product']->product_offer_code) ?>">
                            </div>

                            <!-- Features -->
                            <div class="form-group">
                                <label for="product_features">Product Features:</label>
                                <textarea class="form-control" id="product_features" name="product_features" rows="3"><?php echo htmlspecialchars($results['product']->product_features) ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="saveChanges">Save Product</button>
                    <button type="submit" formnovalidate name="cancel" class="btn btn-secondary" name="cancel">Cancel</button>
                </div>
            </form>
            <?php if ($results['product']->product_id) { ?>
                <p><a href="admin.php?action=deleteProduct&amp;product_id=<?php echo $results['product']->product_id ?>" onclick="return confirm('Delete This Product?')">Delete This Product</a></p>
            <?php } ?>

            <!-- /.container-fluid -->

            <?php include 'templates/admin/include-admin/footer.php'; ?>
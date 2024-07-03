<?php
function validateProduct($product){
    $errors = [];

    // if(empty($product["product_mrp"])) {
    //     $errors['product_mrp'] = 'Valid MRP is required';
    // }

    if(!empty($product["product_mrp"]) && $product["product_selling_price"] >= $product["product_mrp"]){
        $errors["product_selling_price"] = "Selling price must be less than MRP";
    }

    foreach (['product_desc', 'product_small_desc'] as $field) {
        if (!empty($product[$field])) {
            $product[$field] = htmlspecialchars($product[$field], ENT_QUOTES, 'UTF-8');
        }
    }


    return $errors;
}







?>
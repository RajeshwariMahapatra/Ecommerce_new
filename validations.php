<?php
function validateProduct($product)
{
    $error = 200;

    if (empty($product["product_name"]) || !is_string($product["product_name"])) {
        $error = 101;
    } elseif (empty($product["product_desc"]) || !is_string($product["product_desc"])) {
        $error = 102;
    } elseif (empty($product["product_small_desc"]) || !is_string($product["product_small_desc"])) {
        $error = 103;
    } elseif (empty($product["product_stock"]) || !is_numeric($product["product_stock"])) {
        $error = 104;
    } elseif (empty($product["product_mrp"]) || !is_numeric($product["product_mrp"])) {
        $error = 105;
    } elseif (empty($product["product_selling_price"]) || !is_numeric($product["product_selling_price"])) {
        $error = 106;
    } elseif ($product["product_selling_price"] >= $product["product_mrp"]) {
        $error = 107;
    } elseif (empty($product["product_shipping_time_est"]) || !is_string($product["product_shipping_time_est"])) {
        $error = 108;
    } elseif (empty($product["product_tax"]) || !is_numeric($product["product_tax"])) {
        $error = 109;
    } elseif (empty($product["product_hsn_code"]) || !is_string($product["product_hsn_code"])) {
        $error = 110;
    } elseif (empty($product["product_certification"]) || !is_string($product["product_certification"])) {
        $error = 111;
    } elseif (empty($product["product_sku"]) || !is_string($product["product_sku"])) {
        $error = 112;
    } elseif (empty($product["product_code"]) || !is_string($product["product_code"])) {
        $error = 113;
    }

    
    return $error;
}




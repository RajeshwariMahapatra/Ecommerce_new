<?php
function validateProduct($product){

    $error = 200;

    if(($product["product_name"]) == null)
    {
        $error=101;
    }
    elseif($product["product_desc"] == null){
        $error=102;
    }
    elseif($product["product_small_desc"] == null){
        $error=103;
    }
    elseif($product["product_stock"] == null){
        $error=104;
    }
    elseif($product["product_mrp"] == null){
        $error=105;
    }
    elseif($product["product_selling_price"] == null){
        $error=106;
    }
    elseif($product["product_selling_price"] >= $product["product_mrp"]){
        $error =107;
    }
    elseif($product["product_shipping_time_est"] == null){
        $error=108;
    }
    elseif($product["product_tax"] == null){
        $error=109;
    }
    elseif($product["product_hsn_code"] == null){
        $error=110;
    }
    elseif($product["product_certification"] == null){
        $error=111;
    }
    elseif($product["product_sku"] == null){
        $error=112;
    }
    elseif($product["product_code"] == null){
        $error=113;
    }
      
    return $error;
}


foreach (['product_desc', 'product_small_desc'] as $field) {
    if (!empty($product[$field])) {
        $product[$field] = htmlspecialchars($product[$field], ENT_QUOTES, 'UTF-8');
    }
}





?>
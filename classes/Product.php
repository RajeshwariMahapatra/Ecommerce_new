<?php

/**
 * Class to handle products
 */
class Product
{
    // Properties

    /**
     * @var int The product ID from the database
     */
    public $product_id = null;

    /**
     * @var string The unique identity of the product
     */
    public $product_identity = null;

    /**
     * @var int The category ID of the product
     */
    public $product_category_id = null;

    /**
     * @var int The brand ID of the product
     */
    public $product_brand_id = null;

    /**
     * @var int The amount ID of the product
     */
    public $product_mrp = null;

    /**
     * @var string The unique name of the product
     */
    public $product_selling_price  = null;

    /**
     * @var string The description of the product
     */
    public $product_name = null;


    /**
     * @var int The custom variables ID of the product
     */
    public $product_desc = null;

    /**
     * @var int The product image ID 1 of the product
     */
    public $product_small_desc = null;

    /**
     * @var int The product image ID 2 of the product
     */
    public $product_stock = null;

    /**
     * @var int The product image ID 3 of the product
     */
    public $product_product_image_1 = null;

    /**
     * @var int The product image ID 4 of the product
     */
    public $product_product_image_2 = null;

    /**
     * @var int The product image ID 5 of the product
     */
    public $product_product_image_3 = null;


    /**
     * @var int The dimensions ID of the product
     */
    public $product_shipping_time_est = null;

    /**
     * @var string The tags associated with the product
     */
    public $product_breadth = null;

    /**
     * @var int The tax ID associated with the product
     */
    public $product_volume = null;

    /**
     * @var string The HSN code of the product
     */
    public $product_height = null;

    /**
     * @var string The certification details of the product
     */
    public $product_weight = null;

    /**
     * @var string The barcode of the product
     */
    public $product_tags = null;

    /**
     * @var string The SKU of the product
     */
    public $product_tax = null;

    /**
     * @var string The code of the product
     */
    public $product_hsn_code = null;

    /**
     * @var string The code of the product
     */
    public $product_certification = null;


    /**
     * @var string The code of the product
     */
    public $product_barcode = null;

    /**
     * @var string The code of the product
     */
    public $product_sku = null;

    /**
     * @var string The code of the product
     */
    public $product_code = null;

    /**
     * @var string The code of the product
     */
    public $product_warranty = null;

    /**
     * @var string The code of the product
     */
    public $product_guarantee = null;

    /**
     * @var string The code of the product
     */
    public $product_offer_code = null;

    /**
     * @var string The code of the product
     */
    public $product_features = null;

    /**
     * @var string The code of the product
     */
    public $product_created_on = null;


    /**
     * @var string The code of the product
     */
    public $product_updated_on = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param array $data The property values
     */
    public function __construct($data = array())
    {
        if (isset($data['product_id'])) $this->product_id = (int)$data['product_id'];
        if (isset($data['product_identity'])) $this->product_identity = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['product_identity']);
        if (isset($data['product_category_id'])) $this->product_category_id = (int)$data['product_category_id'];
        if (isset($data['product_brand_id'])) $this->product_brand_id = (int)$data['product_brand_id'];
        if (isset($data['product_mrp'])) $this->product_mrp = $data['product_mrp'];
        if (isset($data['product_selling_price '])) $this->product_selling_price  = $data['product_selling_price '];
        if (isset($data['product_name'])) $this->product_name = $data['product_name'];
        if (isset($data['product_desc'])) $this->product_desc = $data['product_desc'];
        if (isset($data['product_small_desc'])) $this->product_small_desc = $data['product_small_desc'];
        if (isset($data['product_stock'])) $this->product_stock = $data['product_stock'];
        if (isset($data['product_product_image_1'])) $this->product_product_image_1 = $data['product_product_image_1'];
        if (isset($data['product_product_image_2'])) $this->product_product_image_2 = $data['product_product_image_2'];
        if (isset($data['product_product_image_3'])) $this->product_product_image_3 = $data['product_product_image_3'];
        if (isset($data['product_shipping_time_est'])) $this->product_shipping_time_est = $data['product_shipping_time_est'];
        if (isset($data['product_breadth'])) $this->product_breadth = $data['product_breadth'];
        if (isset($data['product_volume'])) $this->product_volume = $data['product_volume'];
        if (isset($data['product_height'])) $this->product_height = $data['product_height'];
        if (isset($data['product_weight'])) $this->product_weight = $data['product_weight'];
        if (isset($data['product_tags'])) $this->product_tags = $data['product_tags'];
        if (isset($data['product_tax'])) $this->product_tax = (int)$data['product_tax'];
        if (isset($data['product_hsn_code'])) $this->product_hsn_code = $data['product_hsn_code'];
        if (isset($data['product_certification'])) $this->product_certification = $data['product_certification'];
        if (isset($data['product_barcode'])) $this->product_barcode = $data['product_barcode'];
        if (isset($data['product_sku'])) $this->product_sku = $data['product_sku'];
        if (isset($data['product_code'])) $this->product_code = $data['product_code'];
        if (isset($data['product_warranty'])) $this->product_warranty = $data['product_warranty'];
        if (isset($data['product_guarantee'])) $this->product_guarantee = $data['product_guarantee'];
        if (isset($data['product_offer_code'])) $this->product_offer_code = $data['product_offer_code'];
        if (isset($data['product_features'])) $this->product_features = $data['product_features'];
        if (isset($data['product_created_on'])) $this->product_created_on = $data['product_created_on'];
        if (isset($data['product_updated_on'])) $this->product_updated_on = $data['product_updated_on'];
    }

    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param array $params The form post values
     */
    public function storeFormValues($params)
    {
        // Store all the parameters
        $this->__construct($params);
    }

    /**
     * Returns a Product object matching the given product ID
     *
     * @param int $product_id The product ID
     * @return Product|false The product object, or false if the record was not found or there was a problem
     */
    public static function getById($product_id)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM Product WHERE product_id = :product_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":product_id", $product_id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new Product($row);
    }

    /**
     * Returns all (or a range of) Product objects in the DB
     *
     * @param int $numRows Optional The number of rows to return (default=all)
     * @return array|false A two-element array : results => array, a list of Product objects; totalRows => Total number of products
     */
    public static function getList($numRows = 1000000)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM Product ORDER BY product_id DESC LIMIT :numRows";
        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $product = new Product($row);
            $list[] = $product;
        }

        // Now get the total number of products that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query($sql)->fetch();
        $conn = null;
        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }

    /**
     * Inserts the current Product object into the database, and sets its ID property.
     */
    public function insert()
    {
        // Does the Product object already have an ID?
        if (!is_null($this->product_id)) trigger_error("Product::insert(): Attempt to insert a Product object that already has its ID property set (to $this->product_id).", E_USER_ERROR);

        // Insert the Product
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO Product (product_identity, product_category_id, product_brand_id, product_mrp, product_selling_price, product_name, product_desc, product_small_desc,product_stock, product_product_image_1, product_product_image_2, product_product_image_3, product_breadth,product_volume,product_height,product_weight ,product_tags, product_tax, product_hsn_code, product_certification, product_barcode, product_sku, product_code,product_warranty,product_guarantee,product_offer_code,product_features,product_created_on,product_updated_on) VALUES (:product_identity, :product_category_id, :product_brand_id, :product_mrp, :product_selling_price, :product_name, :product_desc, :product_small_desc,:product_stock, :product_product_image_1, :product_product_image_2, :product_product_image_3, :product_breadth,:product_volume,:product_height,:product_weight ,:product_tags, :product_tax, :product_hsn_code, :product_certification, :product_barcode, :product_sku, :product_code,:product_warranty,:product_guarantee,:product_offer_code,:product_features,:product_created_on,:product_updated_on)";
        $st = $conn->prepare($sql);
        $st->bindValue(":product_identity", $this->product_identity, PDO::PARAM_STR);
        $st->bindValue(":product_category_id", $this->product_category_id, PDO::PARAM_INT);
        $st->bindValue(":product_brand_id", $this->product_brand_id, PDO::PARAM_INT);
        $st->bindValue(":product_mrp", $this->product_mrp, PDO::PARAM_STR);
        $st->bindValue(":product_mrp", $this->product_mrp, PDO::PARAM_STR);
        $st->bindValue(":product_selling_price ", $this->product_selling_price , PDO::PARAM_STR);
        $st->bindValue(":product_desc", $this->product_desc, PDO::PARAM_STR);
        $st->bindValue(":product_name", $this->product_name, PDO::PARAM_STR);
        $st->bindValue(":product_small_desc", $this->product_small_desc, PDO::PARAM_STR);
        $st->bindValue(":product_stock", $this->product_stock, PDO::PARAM_STR);
        $st->bindValue(":product_product_image_1", $this->product_product_image_1, PDO::PARAM_STR);
        $st->bindValue(":product_product_image_2", $this->product_product_image_2, PDO::PARAM_STR);
        $st->bindValue(":product_product_image_3", $this->product_product_image_3, PDO::PARAM_STR);
        $st->bindValue(":product_shipping_time_est", $this->product_shipping_time_est, PDO::PARAM_STR);
        $st->bindValue(":product_breadth", $this->product_breadth, PDO::PARAM_STR);
        $st->bindValue(":product_volume", $this->product_volume, PDO::PARAM_STR);
        $st->bindValue(":product_height", $this->product_height, PDO::PARAM_STR);
        $st->bindValue(":product_weight", $this->product_weight, PDO::PARAM_STR);
        $st->bindValue(":product_tags", $this->product_tags, PDO::PARAM_STR);
        $st->bindValue(":product_tax", $this->product_tax, PDO::PARAM_STR);
        $st->bindValue(":product_hsn_code", $this->product_hsn_code, PDO::PARAM_STR);
        $st->bindValue(":product_certification", $this->product_certification, PDO::PARAM_STR);
        $st->bindValue(":product_barcode", $this->product_barcode, PDO::PARAM_STR);
        $st->bindValue(":product_sku", $this->product_sku, PDO::PARAM_STR);
        $st->bindValue(":product_code", $this->product_code, PDO::PARAM_STR);
        $st->bindValue(":product_warranty", $this->product_warranty, PDO::PARAM_STR);
        $st->bindValue(":product_guarantee", $this->product_guarantee, PDO::PARAM_STR);
        $st->bindValue(":product_offer_code", $this->product_offer_code, PDO::PARAM_STR);
        $st->bindValue(":product_features", $this->product_features, PDO::PARAM_STR);
        $st->bindValue(":product_created_on", $this->product_created_on, PDO::PARAM_INT);
        $st->bindValue(":product_updated_on", $this->product_updated_on, PDO::PARAM_INT);
        $st->execute();
        $this->product_id = $conn->lastInsertId();
        $conn = null;
    }

    /**
     * Updates the current Product object in the database.
     */
    public function update()
    {
        // Does the Product object have an ID?
        if (is_null($this->product_id)) trigger_error("Product::update(): Attempt to update a Product object that does not have its ID property set.", E_USER_ERROR);

        // Update the Product
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE Product 
        SET 
            product_identity = :product_identity,
            product_category_id = :product_category_id,
            product_brand_id = :product_brand_id,
            product_mrp = :product_mrp,
            product_selling_price = :product_selling_price,
            product_name = :product_name,
            product_desc = :product_desc,
            product_small_desc = :product_small_desc,
            product_stock = :product_stock,
            product_product_image_1 = :product_product_image_1,
            product_product_image_2 = :product_product_image_2,
            product_product_image_3 = :product_product_image_3,
            product_breadth = :product_breadth,
            product_volume = :product_volume,
            product_height = :product_height,
            product_weight = :product_weight,
            product_tags = :product_tags,
            product_tax = :product_tax,
            product_hsn_code = :product_hsn_code,
            product_certification = :product_certification,
            product_barcode = :product_barcode,
            product_sku = :product_sku,
            product_code = :product_code,
            product_warranty = :product_warranty,
            product_guarantee = :product_guarantee,
            product_offer_code = :product_offer_code,
            product_features = :product_features,
            product_created_on = :product_created_on,
            product_updated_on = :product_updated_on
        WHERE 
            product_id = :product_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":product_identity", $this->product_identity, PDO::PARAM_STR);
        $st->bindValue(":product_category_id", $this->product_category_id, PDO::PARAM_INT);
        $st->bindValue(":product_brand_id", $this->product_brand_id, PDO::PARAM_INT);
        $st->bindValue(":product_mrp", $this->product_mrp, PDO::PARAM_STR);
        $st->bindValue(":product_mrp", $this->product_mrp, PDO::PARAM_STR);
        $st->bindValue(":product_selling_price ", $this->product_selling_price , PDO::PARAM_STR);
        $st->bindValue(":product_desc", $this->product_desc, PDO::PARAM_STR);
        $st->bindValue(":product_name", $this->product_name, PDO::PARAM_STR);
        $st->bindValue(":product_small_desc", $this->product_small_desc, PDO::PARAM_STR);
        $st->bindValue(":product_stock", $this->product_stock, PDO::PARAM_STR);
        $st->bindValue(":product_product_image_1", $this->product_product_image_1, PDO::PARAM_STR);
        $st->bindValue(":product_product_image_2", $this->product_product_image_2, PDO::PARAM_STR);
        $st->bindValue(":product_product_image_3", $this->product_product_image_3, PDO::PARAM_STR);
        $st->bindValue(":product_shipping_time_est", $this->product_shipping_time_est, PDO::PARAM_STR);
        $st->bindValue(":product_breadth", $this->product_breadth, PDO::PARAM_STR);
        $st->bindValue(":product_volume", $this->product_volume, PDO::PARAM_STR);
        $st->bindValue(":product_height", $this->product_height, PDO::PARAM_STR);
        $st->bindValue(":product_weight", $this->product_weight, PDO::PARAM_STR);
        $st->bindValue(":product_tags", $this->product_tags, PDO::PARAM_STR);
        $st->bindValue(":product_tax", $this->product_tax, PDO::PARAM_STR);
        $st->bindValue(":product_hsn_code", $this->product_hsn_code, PDO::PARAM_STR);
        $st->bindValue(":product_certification", $this->product_certification, PDO::PARAM_STR);
        $st->bindValue(":product_barcode", $this->product_barcode, PDO::PARAM_STR);
        $st->bindValue(":product_sku", $this->product_sku, PDO::PARAM_STR);
        $st->bindValue(":product_code", $this->product_code, PDO::PARAM_STR);
        $st->bindValue(":product_warranty", $this->product_warranty, PDO::PARAM_STR);
        $st->bindValue(":product_guarantee", $this->product_guarantee, PDO::PARAM_STR);
        $st->bindValue(":product_offer_code", $this->product_offer_code, PDO::PARAM_STR);
        $st->bindValue(":product_features", $this->product_features, PDO::PARAM_STR);
        $st->bindValue(":product_created_on", $this->product_created_on, PDO::PARAM_INT);
        $st->bindValue(":product_updated_on", $this->product_updated_on, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    /**
     * Deletes the current Product object from the database.
     */
    public function delete()
    {
        // Does the Product object have an ID?
        if (is_null($this->product_id)) trigger_error("Product::delete(): Attempt to delete a Product object that does not have its ID property set.", E_USER_ERROR);

        // Delete the Product
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM Product WHERE product_id = :product_id LIMIT 1");
        $st->bindValue(":product_id", $this->product_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }
}

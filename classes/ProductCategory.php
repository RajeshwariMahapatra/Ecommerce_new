<?php
/**
 * Class to handle product categories
 */
class ProductCategory
{
    // Properties

    /**
    * @var int The category ID from the database
    */
    public $category_id = null;

    /**
    * @var string The unique identity of the category
    */
    public $category_identity = null;

    /**
    * @var string The name of the category
    */
    public $category_name = null;

    /**
    * @var string The description of the category
    */
    public $category_description = null;

    /**
    * Sets the object's properties using the values in the supplied array
    *
    * @param assoc The property values
    */
    public function __construct($data = array())
    {
        if (isset($data['category_id'])) $this->category_id = (int) $data['category_id'];
        if (isset($data['category_identity'])) $this->category_identity = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['category_identity']);
        if (isset($data['category_name'])) $this->category_name = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['category_name']);
        if (isset($data['category_description'])) $this->category_description = $data['category_description'];
    }

    /**
    * Sets the object's properties using the edit form post values in the supplied array
    *
    * @param assoc The form post values
    */
    public function storeFormValues($params)
    {
        // Store all the parameters
        $this->__construct($params);
    }

    /**
    * Returns a ProductCategory object matching the given category ID
    *
    * @param int The category ID
    * @return ProductCategory|false The category object, or false if the record was not found or there was a problem
    */
    public static function getById($category_id)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM ProductCategory WHERE category_id = :category_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":category_id", $category_id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new ProductCategory($row);
    }

    /**
    * Returns all (or a range of) ProductCategory objects in the DB
    *
    * @param int Optional The number of rows to return (default=all)
    * @return Array|false A two-element array : results => array, a list of ProductCategory objects; totalRows => Total number of categories
    */
    public static function getList($numRows = 1000000)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ProductCategory ORDER BY category_id ASC LIMIT :numRows";
        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $category = new ProductCategory($row);
            $list[] = $category;
        }

        // Now get the total number of categories that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query($sql)->fetch();
        $conn = null;
        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }

    /**
    * Inserts the current ProductCategory object into the database, and sets its ID property.
    */
    public function insert()
    {
        // Does the ProductCategory object already have an ID?
        if (!is_null($this->category_id)) trigger_error("ProductCategory::insert(): Attempt to insert a ProductCategory object that already has its ID property set (to $this->category_id).", E_USER_ERROR);

        // Insert the ProductCategory
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO ProductCategory (category_identity, category_name, category_description) VALUES (:category_identity, :category_name, :category_description)";
        $st = $conn->prepare($sql);
        $st->bindValue(":category_identity", $this->category_identity, PDO::PARAM_STR);
        $st->bindValue(":category_name", $this->category_name, PDO::PARAM_STR);
        $st->bindValue(":category_description", $this->category_description, PDO::PARAM_STR);
        $st->execute();
        $this->category_id = $conn->lastInsertId();
        $conn = null;
    }

    /**
    * Updates the current ProductCategory object in the database.
    */
    public function update()
    {
        // Does the ProductCategory object have an ID?
        if (is_null($this->category_id)) trigger_error("ProductCategory::update(): Attempt to update a ProductCategory object that does not have its ID property set.", E_USER_ERROR);

        // Update the ProductCategory
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE ProductCategory SET category_identity=:category_identity, category_name=:category_name, category_description=:category_description WHERE category_id = :category_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":category_identity", $this->category_identity, PDO::PARAM_STR);
        $st->bindValue(":category_name", $this->category_name, PDO::PARAM_STR);
        $st->bindValue(":category_description", $this->category_description, PDO::PARAM_STR);
        $st->bindValue(":category_id", $this->category_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    /**
    * Deletes the current ProductCategory object from the database.
    */
    public function delete()
    {
        // Does the ProductCategory object have an ID?
        if (is_null($this->category_id)) trigger_error("ProductCategory::delete(): Attempt to delete a ProductCategory object that does not have its ID property set.", E_USER_ERROR);

        // Delete the ProductCategory
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM ProductCategory WHERE category_id = :category_id LIMIT 1");
        $st->bindValue(":category_id", $this->category_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }
}

?>

<?php
/**
 * Class to handle brands
 */
class Brand
{
    // Properties

    /**
     * @var int The brand ID from the database
     */
    public $brand_id = null;

    /**
     * @var string The unique identity of the brand record
     */
    public $brand_identity = null;

    /**
     * @var string The name of the brand
     */
    public $brand_name = null;

    /**
     * @var string The creation timestamp of the brand record
     */
    public $brand_created_at = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param array $data The property values
     */
    public function __construct($data = array())
    {
        if (isset($data['brand_id'])) $this->brand_id = (int)$data['brand_id'];
        if (isset($data['brand_identity'])) $this->brand_identity = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['brand_identity']);
        if (isset($data['brand_name'])) $this->brand_name = $data['brand_name'];
        if (isset($data['brand_created_at'])) $this->brand_created_at = $data['brand_created_at'];
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
     * Returns a Brand object matching the given brand ID
     *
     * @param int $brand_id The brand ID
     * @return Brand|false The brand object, or false if the record was not found or there was a problem
     */
    public static function getById($brand_id)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM Brand WHERE brand_id = :brand_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":brand_id", $brand_id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new Brand($row);
    }

    /**
     * Returns all (or a range of) Brand objects in the DB
     *
     * @param int $numRows Optional The number of rows to return (default=all)
     * @return array|false A two-element array : results => array, a list of Brand objects; totalRows => Total number of brands
     */
    public static function getList($numRows = 1000000)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM Brand ORDER BY brand_id DESC LIMIT :numRows";
        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $brand = new Brand($row);
            $list[] = $brand;
        }

        // Now get the total number of brands that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query($sql)->fetch();
        $conn = null;
        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }

    /**
     * Inserts the current Brand object into the database, and sets its ID property.
     */
    public function insert()
    {
        // Does the Brand object already have an ID?
        if (!is_null($this->brand_id)) trigger_error("Brand::insert(): Attempt to insert a Brand object that already has its ID property set (to $this->brand_id).", E_USER_ERROR);

        // Insert the Brand
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO Brand (brand_identity, brand_name, brand_created_at) VALUES (:brand_identity, :brand_name, :brand_created_at)";
        $st = $conn->prepare($sql);
        $st->bindValue(":brand_identity", $this->brand_identity, PDO::PARAM_STR);
        $st->bindValue(":brand_name", $this->brand_name, PDO::PARAM_STR);
        $st->bindValue(":brand_created_at", $this->brand_created_at, PDO::PARAM_STR);
        $st->execute();
        $this->brand_id = $conn->lastInsertId();
        $conn = null;
    }

    /**
     * Updates the current Brand object in the database.
     */
    public function update()
    {
        // Does the Brand object have an ID?
        if (is_null($this->brand_id)) trigger_error("Brand::update(): Attempt to update a Brand object that does not have its ID property set.", E_USER_ERROR);

        // Update the Brand
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE Brand SET brand_identity=:brand_identity, brand_name=:brand_name, brand_created_at=:brand_created_at WHERE brand_id = :brand_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":brand_identity", $this->brand_identity, PDO::PARAM_STR);
        $st->bindValue(":brand_name", $this->brand_name, PDO::PARAM_STR);
        $st->bindValue(":brand_created_at", $this->brand_created_at, PDO::PARAM_STR);
        $st->bindValue(":brand_id", $this->brand_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
        }
        /**
 * Deletes the current Brand object from the database.
 */
public function delete()
{
    // Does the Brand object have an ID?
    if (is_null($this->brand_id)) trigger_error("Brand::delete(): Attempt to delete a Brand object that does not have its ID property set.", E_USER_ERROR);

    // Delete the Brand
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $st = $conn->prepare("DELETE FROM Brand WHERE brand_id = :brand_id LIMIT 1");
    $st->bindValue(":brand_id", $this->brand_id, PDO::PARAM_INT);
    $st->execute();
    $conn = null;
}
}

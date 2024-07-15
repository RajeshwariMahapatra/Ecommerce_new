<?php
/**
 * Class to handle discounts
 */
class Discounts
{
    // Properties

    /**
     * @var int The discount ID from the database
     */
    public $discount_id = null;

    /**
     * @var string The identity of the discount
     */
    public $discount_identity = null;

    /**
     * @var string The unique code of the discount
     */
    public $discount_code = null;

    /**
     * @var string The type of the discount ('percentage' or 'fixed')
     */
    public $discount_type = null;

    /**
     * @var float The value of the discount
     */
    public $discount_value = null;

    /**
     * @var string The start date of the discount
     */
    public $start_date = null;

    /**
     * @var string The end date of the discount
     */
    public $end_date = null;

    /**
     * @var float The minimum order value for the discount
     */
    public $minimum_order_value = null;

    /**
     * @var int The usage limit of the discount
     */
    public $usage_limit = null;

    /**
     * @var int The number of times the discount has been used
     */
    public $times_used = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */
    public function __construct($data = array())
    {
        if (isset($data['discount_id'])) $this->discount_id = (int) $data['discount_id'];
        if (isset($data['discount_identity'])) $this->discount_identity = $data['discount_identity'];
        if (isset($data['discount_code'])) $this->discount_code = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['discount_code']);
        if (isset($data['discount_type'])) $this->discount_type = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['discount_type']);
        if (isset($data['discount_value'])) $this->discount_value = (float) $data['discount_value'];
        if (isset($data['start_date'])) $this->start_date = $data['start_date'];
        if (isset($data['end_date'])) $this->end_date = $data['end_date'];
        if (isset($data['minimum_order_value'])) $this->minimum_order_value = (float) $data['minimum_order_value'];
        if (isset($data['usage_limit'])) $this->usage_limit = (int) $data['usage_limit'];
        if (isset($data['times_used'])) $this->times_used = (int) $data['times_used'];
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
     * Returns a Discount object matching the given discount ID
     *
     * @param int The discount ID
     * @return Discounts|false The discount object, or false if the record was not found or there was a problem
     */
    public static function getById($discount_id)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM discounts WHERE discount_id = :discount_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":discount_id", $discount_id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new Discounts($row);
        return false;
    }

    public static function getByCode($discount_code)
{
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT * FROM discounts WHERE discount_code = :discount_code AND start_date <= NOW() AND end_date >= NOW()";
    $st = $conn->prepare($sql);
    $st->bindValue(":discount_code", $discount_code, PDO::PARAM_STR);
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ($row) return new Discounts($row);
    return false;
}

    /**
     * Returns all (or a range of) Discount objects in the DB
     *
     * @param int Optional The number of rows to return (default=all)
     * @return Array|false A two-element array : results => array, a list of Discount objects; totalRows => Total number of discounts
     */
    public static function getList($numRows = 1000000)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM discounts
                ORDER BY start_date DESC LIMIT :numRows";
        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $discount = new Discounts($row);
            $list[] = $discount;
        }

        // Now get the total number of discounts that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query($sql)->fetch();
        $conn = null;
        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }

    /**
     * Inserts the current Discount object into the database, and sets its ID property.
     */
    public function insert()
    {
        if (!is_null($this->discount_id)) {
            trigger_error("Discounts::insert(): Attempt to insert a Discount object that already has its ID property set (to $this->discount_id).", E_USER_ERROR);
        }

        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set PDO error mode to exception

            $sql = "INSERT INTO discounts (
                discount_identity, discount_code, discount_type, discount_value, start_date, end_date, 
                minimum_order_value, usage_limit, times_used
            ) VALUES (
                :discount_identity, :discount_code, :discount_type, :discount_value, :start_date, :end_date, 
                :minimum_order_value, :usage_limit, :times_used
            )";

            $st = $conn->prepare($sql);
            $st->bindValue(":discount_identity", $this->discount_identity, PDO::PARAM_STR);
            $st->bindValue(":discount_code", $this->discount_code, PDO::PARAM_STR);
            $st->bindValue(":discount_type", $this->discount_type, PDO::PARAM_STR);
            $st->bindValue(":discount_value", $this->discount_value, PDO::PARAM_STR);
            $st->bindValue(":start_date", $this->start_date, PDO::PARAM_STR);
            $st->bindValue(":end_date", $this->end_date, PDO::PARAM_STR);
            $st->bindValue(":minimum_order_value", $this->minimum_order_value, PDO::PARAM_STR);
            $st->bindValue(":usage_limit", $this->usage_limit, PDO::PARAM_INT);
            $st->bindValue(":times_used", $this->times_used, PDO::PARAM_INT);
            $st->execute();
            $this->discount_id = $conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    /**
     * Updates the current Discount object in the database.
     */
    public function update()
    {
        // Does the Discount object have an ID?
        if (is_null($this->discount_id)) {
            trigger_error("Discounts::update(): Attempt to update a Discount object that does not have its ID property set.", E_USER_ERROR);
        }

        // Update the Discount
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE discounts SET 
            discount_identity=:discount_identity,
            discount_code=:discount_code, 
            discount_type=:discount_type, 
            discount_value=:discount_value, 
            start_date=:start_date, 
            end_date=:end_date,
            minimum_order_value=:minimum_order_value,
            usage_limit=:usage_limit,
            times_used=:times_used
            WHERE discount_id = :discount_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":discount_identity", $this->discount_identity, PDO::PARAM_STR);
        $st->bindValue(":discount_code", $this->discount_code, PDO::PARAM_STR);
        $st->bindValue(":discount_type", $this->discount_type, PDO::PARAM_STR);
        $st->bindValue(":discount_value", $this->discount_value, PDO::PARAM_STR);
        $st->bindValue(":start_date", $this->start_date, PDO::PARAM_STR);
        $st->bindValue(":end_date", $this->end_date, PDO::PARAM_STR);
        $st->bindValue(":minimum_order_value", $this->minimum_order_value, PDO::PARAM_STR);
        $st->bindValue(":usage_limit", $this->usage_limit, PDO::PARAM_INT);
        $st->bindValue(":times_used", $this->times_used, PDO::PARAM_INT);
        $st->bindValue(":discount_id", $this->discount_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    /**
     * Deletes the current Discount object from the database.
     */
    public function delete()
    {
        // Does the Discount object have an ID?
        if (is_null($this->discount_id)) {
            trigger_error("Discounts::delete(): Attempt to delete a Discount object that does not have its ID property set.", E_USER_ERROR);
        }

        // Delete the Discount
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM discounts WHERE discount_id = :discount_id LIMIT 1");
        $st->bindValue(":discount_id", $this->discount_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }
}
?>

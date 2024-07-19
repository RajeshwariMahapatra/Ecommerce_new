<?php
/**
 * Class to handle states
 */
class State
{
    // Properties

    /**
    * @var int The state ID from the database
    */
    public $state_id = null;

    /**
    * @var string The unique identity of the state
    */
    public $state_identity = null;

    /**
    * @var string The name of the state
    */
    public $state_name = null;

    /**
    * @var string The GST code of the state
    */
    public $state_gst_code = null;

    /**
    * Sets the object's properties using the values in the supplied array
    *
    * @param assoc The property values
    */
    public function __construct($data = array())
    {
        if (isset($data['state_id'])) $this->state_id = (int) $data['state_id'];
        if (isset($data['state_identity'])) $this->state_identity = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['state_identity']);
        if (isset($data['state_name'])) $this->state_name = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['state_name']);
        if (isset($data['state_gst_code'])) $this->state_gst_code = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['state_gst_code']);
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
    * Returns a State object matching the given state ID
    *
    * @param int The state ID
    * @return State|false The state object, or false if the record was not found or there was a problem
    */
    public static function getById($state_id)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM State WHERE state_id = :state_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":state_id", $state_id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new State($row);
    }

    /**
    * Returns all (or a range of) State objects in the DB
    *
    * @param int Optional The number of rows to return (default=all)
    * @return Array|false A two-element array : results => array, a list of State objects; totalRows => Total number of states
    */
    public static function getList($numRows = 1000000)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM State ORDER BY state_id ASC LIMIT :numRows";
        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $state = new State($row);
            $list[] = $state;
        }

        // Now get the total number of states that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query($sql)->fetch();
        $conn = null;
        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }

    public static function getStates() {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM State";
        $st = $conn->prepare($sql);
        $st->execute();
        $states = $st->fetchAll(PDO::FETCH_OBJ);
        $conn = null;
        return $states;
    }
   
    /**
    * Inserts the current State object into the database, and sets its ID property.
    */
    public function insert()
    {
        // Does the State object already have an ID?
        if (!is_null($this->state_id)) trigger_error("State::insert(): Attempt to insert a State object that already has its ID property set (to $this->state_id).", E_USER_ERROR);

        // Insert the State
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO State (state_identity, state_name, state_gst_code) VALUES (:state_identity, :state_name, :state_gst_code)";
        $st = $conn->prepare($sql);
        $st->bindValue(":state_identity", $this->state_identity, PDO::PARAM_STR);
        $st->bindValue(":state_name", $this->state_name, PDO::PARAM_STR);
        $st->bindValue(":state_gst_code", $this->state_gst_code, PDO::PARAM_STR);
        $st->execute();
        $this->state_id = $conn->lastInsertId();
        $conn = null;
    }

    /**
    * Updates the current State object in the database.
    */
    public function update()
    {
        // Does the State object have an ID?
        if (is_null($this->state_id)) trigger_error("State::update(): Attempt to update a State object that does not have its ID property set.", E_USER_ERROR);

        // Update the State
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE State SET state_identity=:state_identity, state_name=:state_name, state_gst_code=:state_gst_code WHERE state_id = :state_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":state_identity", $this->state_identity, PDO::PARAM_STR);
        $st->bindValue(":state_name", $this->state_name, PDO::PARAM_STR);
        $st->bindValue(":state_gst_code", $this->state_gst_code, PDO::PARAM_STR);
        $st->bindValue(":state_id", $this->state_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    /**
    * Deletes the current State object from the database.
    */
    public function delete()
    {
        // Does the State object have an ID?
        if (is_null($this->state_id)) trigger_error("State::delete(): Attempt to delete a State object that does not have its ID property set.", E_USER_ERROR);

        // Delete the State
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM State WHERE state_id = :state_id LIMIT 1");
        $st->bindValue(":state_id", $this->state_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }
}

?>

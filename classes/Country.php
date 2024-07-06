<?php
/**
 * Class to handle countries
 */
class Country
{
    // Properties

    /**
    * @var int The country ID from the database
    */
    public $country_id = null;

    /**
    * @var string The unique identity of the country
    */
    public $country_identity = null;

    /**
    * @var string The name of the country
    */
    public $country_name = null;

    /**
    * @var string The code of the country
    */
    public $country_code = null;

    /**
    * @var string The currency of the country
    */
    public $country_currency = null;

    /**
    * @var string The language of the country
    */
    public $country_language = null;

    /**
    * Sets the object's properties using the values in the supplied array
    *
    * @param assoc The property values
    */
    public function __construct($data = array())
    {
        if (isset($data['country_id'])) $this->country_id = (int) $data['country_id'];
        if (isset($data['country_identity'])) $this->country_identity = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['country_identity']);
        if (isset($data['country_name'])) $this->country_name = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['country_name']);
        if (isset($data['country_code'])) $this->country_code = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['country_code']);
        if (isset($data['country_currency'])) $this->country_currency = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['country_currency']);
        if (isset($data['country_language'])) $this->country_language = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['country_language']);
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
    * Returns a Country object matching the given country ID
    *
    * @param int The country ID
    * @return Country|false The country object, or false if the record was not found or there was a problem
    */
    public static function getById($country_id)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM Country WHERE country_id = :country_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":country_id", $country_id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new Country($row);
    }

    /**
    * Returns all (or a range of) Country objects in the DB
    *
    * @param int Optional The number of rows to return (default=all)
    * @return Array|false A two-element array : results => array, a list of Country objects; totalRows => Total number of countries
    */
    public static function getList($numRows = 1000000)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM Country ORDER BY country_id ASC LIMIT :numRows";
        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $country = new Country($row);
            $list[] = $country;
        }

        // Now get the total number of countries that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query($sql)->fetch();
        $conn = null;
        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }

    /**
    * Inserts the current Country object into the database, and sets its ID property.
    */
    public function insert()
    {
        // Does the Country object already have an ID?
        if (!is_null($this->country_id)) trigger_error("Country::insert(): Attempt to insert a Country object that already has its ID property set (to $this->country_id).", E_USER_ERROR);

        // Insert the Country
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO Country (country_identity, country_name, country_code, country_currency, country_language) VALUES (:country_identity, :country_name, :country_code, :country_currency, :country_language)";
        $st = $conn->prepare($sql);
        $st->bindValue(":country_identity", $this->country_identity, PDO::PARAM_STR);
        $st->bindValue(":country_name", $this->country_name, PDO::PARAM_STR);
        $st->bindValue(":country_code", $this->country_code, PDO::PARAM_STR);
        $st->bindValue(":country_currency", $this->country_currency, PDO::PARAM_STR);
        $st->bindValue(":country_language", $this->country_language, PDO::PARAM_STR);
        $st->execute();
        $this->country_id = $conn->lastInsertId();
        $conn = null;
    }

    /**
    * Updates the current Country object in the database.
    */
    public function update()
    {
        // Does the Country object have an ID?
        if (is_null($this->country_id)) trigger_error("Country::update(): Attempt to update a Country object that does not have its ID property set.", E_USER_ERROR);

        // Update the Country
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE Country SET country_identity=:country_identity, country_name=:country_name, country_code=:country_code, country_currency=:country_currency, country_language=:country_language WHERE country_id = :country_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":country_identity", $this->country_identity, PDO::PARAM_STR);
        $st->bindValue(":country_name", $this->country_name, PDO::PARAM_STR);
        $st->bindValue(":country_code", $this->country_code, PDO::PARAM_STR);
        $st->bindValue(":country_currency", $this->country_currency, PDO::PARAM_STR);
        $st->bindValue(":country_language", $this->country_language, PDO::PARAM_STR);
        $st->bindValue(":country_id", $this->country_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    /**
    * Deletes the current Country object from the database.
    */
    public function delete()
    {
        // Does the Country object have an ID?
        if (is_null($this->country_id)) trigger_error("Country::delete(): Attempt to delete a Country object that does not have its ID property set.", E_USER_ERROR);

        // Delete the Country
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM Country WHERE country_id = :country_id LIMIT 1");
        $st->bindValue(":country_id", $this->country_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }
}

?>

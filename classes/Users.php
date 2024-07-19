<?php

/**
 * Class to handle users
 */
class Users
{
    // Properties

    /**
     * @var int The user ID from the database
     */
    public $user_id = null;

    /**
     * @var string The unique identity of the user
     */
    public $user_identity = null;

    /**
     * @var string The name of the user
     */
    public $user_name = null;

    /**
     * @var string The password of the user
     */
    public $user_password = null;

    /**
     * @var string The email of the user
     */
    public $user_email = null;

    /**
     * @var string The contact number of the user
     */
    /**
     * @var string The contact number of the user
     */
    public $user_contact_no = null;

    /**
     * @var string The country code of the user
     */
    public $user_country_code = null;

    /**
     * @var string The first line of the user's address
     */
    public $user_address_line1 = null;

    /**
     * @var string The second line of the user's address
     */
    public $user_address_line2 = null;

    /**
     * @var string The city of the user's address
     */
    public $user_address_city = null;

    /**
     * @var int The state ID of the user's address
     */
    public $user_address_state_id = null;

    /**
     * @var int The country ID of the user's address
     */
    public $user_address_country_id = null;

    /**
     * @var string The postal code of the user's address
     */
    public $user_address_pin_code = null;

    /**
     * @var int When the user was created
     */
    public $user_created_at = null;

    /**
     * @var string The birthdate of the user
     */
    public $user_birthdate = null;

    /**
     * @var boolean The status of the user
     */
    public $user_status = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */
    public function __construct($data = array())
    {
        if (isset($data['user_id'])) $this->user_id = (int) $data['user_id'];
        if (isset($data['user_identity'])) $this->user_identity = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['user_identity']);
        if (isset($data['user_name'])) $this->user_name = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['user_name']);
        if (isset($data['user_password'])) $this->user_password = $data['user_password'];
        if (isset($data['user_email'])) $this->user_email = filter_var($data['user_email'], FILTER_SANITIZE_EMAIL);
        if (isset($data['user_contact_no'])) $this->user_contact_no = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['user_contact_no']);
        if (isset($data['user_country_code'])) $this->user_country_code = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['user_country_code']);
        if (isset($data['user_created_at'])) $this->user_created_at = $data['user_created_at'];
        if (isset($data['user_birthdate'])) $this->user_birthdate = $data['user_birthdate'];
        if (isset($data['user_status'])) $this->user_status = (bool) $data['user_status'];

        if (isset($data['user_address_line1'])) $this->user_address_line1 = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['user_address_line1']);
        if (isset($data['user_address_line2'])) $this->user_address_line2 = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['user_address_line2']);
        if (isset($data['user_address_city'])) $this->user_address_city = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['user_address_city']);
        if (isset($data['user_address_state_id'])) $this->user_address_state_id = (int) $data['user_address_state_id'];
        if (isset($data['user_address_country_id'])) $this->user_address_country_id = (int) $data['user_address_country_id'];
        if (isset($data['user_address_pin_code'])) $this->user_address_pin_code = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['user_address_pin_code']);
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

        // Parse and store the created at date
        if (isset($params['user_created_at'])) {
            $this->user_created_at = strtotime($params['user_created_at']);
        }
    }

    /**
     * Returns a User object matching the given user ID
     *
     * @param int The user ID
     * @return Users|false The user object, or false if the record was not found or there was a problem
     */
    public static function getById($user_id)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM Users WHERE user_id = :user_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new Users($row);
    }

    /**
     * Returns all (or a range of) User objects in the DB
     *
     * @param int Optional The number of rows to return (default=all)
     * @return Array|false A two-element array : results => array, a list of User objects; totalRows => Total number of users
     */
    public static function getList($numRows = 1000000)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(user_created_at) AS user_created_at FROM Users
                ORDER BY user_created_at DESC LIMIT :numRows";

        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $user = new Users($row);
            $list[] = $user;
        }

        // Now get the total number of users that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query($sql)->fetch();
        $conn = null;
        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }

    public static function getByEmail($email) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM Users WHERE user_email = :email LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindValue(":email", $email, PDO::PARAM_STR);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new Users($row);
        return false;
    }
    

    public static function getStateById($state_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT state_name FROM State WHERE state_id = :state_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":state_id", $state_id, PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public static function getCountryById($country_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT country_name FROM Country WHERE country_id = :country_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":country_id", $country_id, PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Inserts the current User object into the database, and sets its ID property.
     */
    public function insert() {
        if (!is_null($this->user_id)) trigger_error("Users::insert(): Attempt to insert a User object that already has its ID property set (to $this->user_id).", E_USER_ERROR);

        // Insert the user into the database
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO users (user_identity, user_name, user_password, user_email, user_country_code, user_contact_no, user_birthdate, user_address_line1, user_address_line2, user_address_city, user_address_state_id, user_address_country_id, user_address_pin_code, user_created_at, user_status) VALUES (:user_identity, :user_name, :user_password, :user_email, :user_country_code, :user_contact_no, :user_birthdate, :user_address_line1, :user_address_line2, :user_address_city, :user_address_state_id, :user_address_country_id, :user_address_pin_code, :user_created_at, :user_status)";
        $st = $conn->prepare($sql);
        $st->bindValue(":user_identity", $this->user_identity, PDO::PARAM_STR);
        $st->bindValue(":user_name", $this->user_name, PDO::PARAM_STR);
        $st->bindValue(":user_password", $this->user_password, PDO::PARAM_STR);
        $st->bindValue(":user_email", $this->user_email, PDO::PARAM_STR);
        $st->bindValue(":user_country_code", $this->user_country_code, PDO::PARAM_STR);
        $st->bindValue(":user_contact_no", $this->user_contact_no, PDO::PARAM_STR);
        $st->bindValue(":user_birthdate", $this->user_birthdate, PDO::PARAM_STR);
        $st->bindValue(":user_address_line1", $this->user_address_line1, PDO::PARAM_STR);
        $st->bindValue(":user_address_line2", $this->user_address_line2, PDO::PARAM_STR);
        $st->bindValue(":user_address_city", $this->user_address_city, PDO::PARAM_STR);
        $st->bindValue(":user_address_state_id", $this->user_address_state_id, PDO::PARAM_INT);
        $st->bindValue(":user_address_country_id", $this->user_address_country_id, PDO::PARAM_INT);
        $st->bindValue(":user_address_pin_code", $this->user_address_pin_code, PDO::PARAM_STR);
        $st->bindValue(":user_created_at", $this->user_created_at, PDO::PARAM_INT);
        $st->bindValue(":user_status", $this->user_status, PDO::PARAM_INT);
        $st->execute();
        $this->user_id = $conn->lastInsertId();
        $conn = null;
    }
    
    /**
     * Updates the current User object in the database.
     */
    public function update()
    {
        // Does the User object have an ID?
        if (is_null($this->user_id)) {
            trigger_error("Users::update(): Attempt to update a User object that does not have its ID property set.", E_USER_ERROR);
        }

        // Update the User
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE Users SET 
            user_identity=:user_identity, 
            user_name=:user_name, 
            user_password=:user_password, 
            user_email=:user_email, 
            user_contact_no=:user_contact_no, 
            user_country_code=:user_country_code, 
            user_created_at=FROM_UNIXTIME(:user_created_at), 
            user_birthdate=:user_birthdate, 
            user_status=:user_status,
            user_address_line1=:user_address_line1,
            user_address_line2=:user_address_line2,
            user_address_city=:user_address_city,
            user_address_state_id=:user_address_state_id,
            user_address_country_id=:user_address_country_id,
            user_address_pin_code=:user_address_pin_code
            WHERE user_id = :user_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":user_identity", $this->user_identity, PDO::PARAM_STR);
        $st->bindValue(":user_name", $this->user_name, PDO::PARAM_STR);
        $st->bindValue(":user_password", $this->user_password, PDO::PARAM_STR);
        $st->bindValue(":user_email", $this->user_email, PDO::PARAM_STR);
        $st->bindValue(":user_contact_no", $this->user_contact_no, PDO::PARAM_STR);
        $st->bindValue(":user_country_code", $this->user_country_code, PDO::PARAM_STR);
        $st->bindValue(":user_created_at", $this->user_created_at, PDO::PARAM_INT);
        $st->bindValue(":user_birthdate", $this->user_birthdate, PDO::PARAM_STR);
        $st->bindValue(":user_status", $this->user_status, PDO::PARAM_BOOL);
        $st->bindValue(":user_address_line1", $this->user_address_line1, PDO::PARAM_STR);
        $st->bindValue(":user_address_line2", $this->user_address_line2, PDO::PARAM_STR);
        $st->bindValue(":user_address_city", $this->user_address_city, PDO::PARAM_STR);
        $st->bindValue(":user_address_state_id", $this->user_address_state_id, PDO::PARAM_INT);
        $st->bindValue(":user_address_country_id", $this->user_address_country_id, PDO::PARAM_INT);
        $st->bindValue(":user_address_pin_code", $this->user_address_pin_code, PDO::PARAM_STR);
        $st->bindValue(":user_id", $this->user_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    /**
     * Deletes the current User object from the database.
     */
    public function delete()
    {
        // Does the User object have an ID?
        if (is_null($this->user_id)) trigger_error("Users::delete(): Attempt to delete a User object that does not have its ID property set.", E_USER_ERROR);

        // Delete the User
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM Users WHERE user_id = :user_id LIMIT 1");
        $st->bindValue(":user_id", $this->user_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }
}
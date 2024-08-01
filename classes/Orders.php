<?php
/**
 * Class to handle orders
 */
class Orders
{
    // Properties

    /**
     * @var int The order ID from the database
     */
    public $order_id = null;

    /**
     * @var string The identity of the order
     */
    public $order_identity = null;

    /**
     * @var int The user ID from the Users table
     */
    public $user_id = null;

    /**
     * @var string The delivery address line 1
     */
    public $delivery_address_line1 = null;

    /**
     * @var string The delivery address line 2
     */
    public $delivery_address_line2 = null;

    /**
     * @var string The delivery city
     */
    public $delivery_city = null;

    /**
     * @var int The delivery state ID
     */
    public $delivery_state_id = null;

    /**
     * @var int The delivery country ID
     */
    public $delivery_country_id = null;

    /**
     * @var string The delivery pin code
     */
    public $delivery_pin_code = null;

    /**
     * @var string The billing name
     */
    public $billing_name = null;

    /**
     * @var string The billing address
     */
    public $billing_address = null;

    /**
     * @var string The billing email
     */
    public $billing_email = null;

    /**
     * @var string The billing phone
     */
    public $billing_phone = null;

    /**
     * @var string The order notes
     */
    public $order_notes = null;

    /**
     * @var int The order total
     */
    public $order_total = null;

    /**
     * @var string The order status
     */
    public $order_status = 'Pending';

    /**
     * @var string The order created at timestamp
     */
    public $order_created_at = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */
    public function __construct($data = array())
    {
        if (isset($data['order_id'])) $this->order_id = (int) $data['order_id'];
        if (isset($data['order_identity'])) $this->order_identity = $data['order_identity'];
        if (isset($data['user_id'])) $this->user_id = (int) $data['user_id'];
        if (isset($data['delivery_address_line1'])) $this->delivery_address_line1 = $data['delivery_address_line1'];
        if (isset($data['delivery_address_line2'])) $this->delivery_address_line2 = $data['delivery_address_line2'];
        if (isset($data['delivery_city'])) $this->delivery_city = $data['delivery_city'];
        if (isset($data['delivery_state_id'])) $this->delivery_state_id = (int) $data['delivery_state_id'];
        if (isset($data['delivery_country_id'])) $this->delivery_country_id = (int) $data['delivery_country_id'];
        if (isset($data['delivery_pin_code'])) $this->delivery_pin_code = $data['delivery_pin_code'];
        if (isset($data['billing_name'])) $this->billing_name = $data['billing_name'];
        if (isset($data['billing_address'])) $this->billing_address = $data['billing_address'];
        if (isset($data['billing_email'])) $this->billing_email = $data['billing_email'];
        if (isset($data['billing_phone'])) $this->billing_phone = $data['billing_phone'];
        if (isset($data['order_notes'])) $this->order_notes = $data['order_notes'];
        if (isset($data['order_total'])) $this->order_total = (int) $data['order_total'];
        if (isset($data['order_status'])) $this->order_status = $data['order_status'];
        if (isset($data['order_created_at'])) $this->order_created_at = $data['order_created_at'];
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
     * Returns an Orders object matching the given order ID
     *
     * @param int The order ID
     * @return Orders|false The order object, or false if the record was not found or there was a problem
     */
    public static function getById($order_id)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM orders WHERE order_id = :order_id";
        $st = $conn->prepare($sql);
        $st->bindValue(":order_id", $order_id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new Orders($row);
        return false;
    }

    /**
     * Get user checkout data including user details, states, countries, and discounted price
     *
     * @param int $user_id
     * @return array
     */
    public function getUserCheckoutData($user_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        
        // Fetch user details from the database
        $sql = "SELECT user_name, user_email, user_contact_no, user_address_line1, user_address_line2, user_address_city, user_address_state_id, user_address_country_id, user_address_pin_code FROM Users WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Fetch states and countries for dropdowns
        $states = $conn->query("SELECT state_id, state_name FROM State")->fetchAll(PDO::FETCH_ASSOC);
        $countries = $conn->query("SELECT country_id, country_name FROM Country")->fetchAll(PDO::FETCH_ASSOC);
    
        // Fetch discounted price from cookies
        $discounted_price = isset($_COOKIE['discounted_price']) ? $_COOKIE['discounted_price'] : '0.00';
    
        return [
            'user' => $user,
            'states' => $states,
            'countries' => $countries,
            'discounted_price' => $discounted_price
        ];
    }

    /**
     * Place an order
     *
     * @param array $order_data
     * @return bool
     */
    public function placeOrder($order_data) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO orders (user_id, delivery_address_line1, delivery_address_line2, delivery_city, delivery_state_id, delivery_country_id, delivery_pin_code, order_notes, billing_name, billing_address, billing_email, billing_phone, order_total) 
                VALUES (:user_id, :delivery_address_line1, :delivery_address_line2, :delivery_city, :delivery_state_id, :delivery_country_id, :delivery_pin_code, :order_notes, :billing_name, :billing_address, :billing_email, :billing_phone, :order_total)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute($order_data);
    }


    /**
     * Retrieves the ID of the currently logged-in user from the session.
     *
     * @return int|null The ID of the logged-in user, or null if no user is logged in.
     */
    public static function getLoggedInUserId() {
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // Return the user ID from the session
            return (int) $_SESSION['user_id'];
        }
        
        // Return null if no user is logged in
        return null;
    }

    public static function getLastOrderId()
    {
        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT MAX(order_id) AS last_order_id FROM Orders";
            $st = $conn->prepare($sql);
            $st->execute();

            $row = $st->fetch(PDO::FETCH_ASSOC);
            return $row['last_order_id'];
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    /**
 * Inserts the current Order object into the database, and sets its ID property.
 */
public function insert() {
    if (!is_null($this->order_id)) {
        trigger_error("Orders::insert(): Attempt to insert an Order object that already has its ID property set (to $this->order_id).", E_USER_ERROR);
    }

    // Ensure all required fields are not null
    if (is_null($this->order_identity) || is_null($this->user_id) || is_null($this->billing_name)) {
        throw new Exception("Error: Required fields cannot be null");
    }

    try {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO orders (
            order_identity, user_id, delivery_address_line1, delivery_address_line2, delivery_city, delivery_state_id, delivery_country_id, 
            delivery_pin_code, billing_name, billing_address, billing_email, billing_phone, order_notes, order_total, order_status, order_created_at
        ) VALUES (
            :order_identity, :user_id, :delivery_address_line1, :delivery_address_line2, :delivery_city, :delivery_state_id, :delivery_country_id, 
            :delivery_pin_code, :billing_name, :billing_address, :billing_email, :billing_phone, :order_notes, :order_total, :order_status, :order_created_at
        )";

        $st = $conn->prepare($sql);

        $st->bindValue(":order_identity", $this->order_identity, PDO::PARAM_STR);
        $st->bindValue(":user_id", $this->user_id, PDO::PARAM_INT);
        $st->bindValue(":delivery_address_line1", $this->delivery_address_line1, PDO::PARAM_STR);
        $st->bindValue(":delivery_address_line2", $this->delivery_address_line2, PDO::PARAM_STR);
        $st->bindValue(":delivery_city", $this->delivery_city, PDO::PARAM_STR);
        $st->bindValue(":delivery_state_id", $this->delivery_state_id, PDO::PARAM_INT);
        $st->bindValue(":delivery_country_id", $this->delivery_country_id, PDO::PARAM_INT);
        $st->bindValue(":delivery_pin_code", $this->delivery_pin_code, PDO::PARAM_STR);
        $st->bindValue(":billing_name", $this->billing_name, PDO::PARAM_STR);
        $st->bindValue(":billing_address", $this->billing_address, PDO::PARAM_STR);
        $st->bindValue(":billing_email", $this->billing_email, PDO::PARAM_STR);
        $st->bindValue(":billing_phone", $this->billing_phone, PDO::PARAM_STR);
        $st->bindValue(":order_notes", $this->order_notes, PDO::PARAM_STR);
        $st->bindValue(":order_total", $this->order_total, PDO::PARAM_INT);  // Changed to integer
        $st->bindValue(":order_status", $this->order_status, PDO::PARAM_STR);
        $st->bindValue(":order_created_at", $this->order_created_at, PDO::PARAM_STR);

        $st->execute();

        $this->order_id = $conn->lastInsertId();

        $conn = null;
    } catch (PDOException $e) {
        throw new Exception("Database Error: " . $e->getMessage());
    } catch (Exception $e) {
        throw new Exception("General Error: " . $e->getMessage());
    }
}

    /**
     * Updates the current Order object in the database.
     */
    public function update() {
        if (is_null($this->order_id)) {
            trigger_error("Orders::update(): Attempt to update an Order object that does not have its ID property set.", E_USER_ERROR);
        }

        // Ensure all required fields are not null
        if (is_null($this->order_identity) || is_null($this->user_id) || is_null($this->billing_name)) {
            throw new Exception("Error: Required fields cannot be null");
        }

        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE orders SET 
                order_identity = :order_identity, user_id = :user_id, delivery_address_line1 = :delivery_address_line1, 
                delivery_address_line2 = :delivery_address_line2, delivery_city = :delivery_city, delivery_state_id = :delivery_state_id, 
                delivery_country_id = :delivery_country_id, delivery_pin_code = :delivery_pin_code, billing_name = :billing_name, 
                billing_address = :billing_address, billing_email = :billing_email, billing_phone = :billing_phone, order_notes = :order_notes, 
                order_total = :order_total, order_status = :order_status, order_created_at = :order_created_at
                WHERE order_id = :order_id";

            $st = $conn->prepare($sql);

            $st->bindValue(":order_identity", $this->order_identity, PDO::PARAM_STR);
            $st->bindValue(":user_id", $this->user_id, PDO::PARAM_INT);
            $st->bindValue(":delivery_address_line1", $this->delivery_address_line1, PDO::PARAM_STR);
            $st->bindValue(":delivery_address_line2", $this->delivery_address_line2, PDO::PARAM_STR);
            $st->bindValue(":delivery_city", $this->delivery_city, PDO::PARAM_STR);
            $st->bindValue(":delivery_state_id", $this->delivery_state_id, PDO::PARAM_INT);
            $st->bindValue(":delivery_country_id", $this->delivery_country_id, PDO::PARAM_INT);
            $st->bindValue(":delivery_pin_code", $this->delivery_pin_code, PDO::PARAM_STR);
            $st->bindValue(":billing_name", $this->billing_name, PDO::PARAM_STR);
            $st->bindValue(":billing_address", $this->billing_address, PDO::PARAM_STR);
            $st->bindValue(":billing_email", $this->billing_email, PDO::PARAM_STR);
            $st->bindValue(":billing_phone", $this->billing_phone, PDO::PARAM_STR);
            $st->bindValue(":order_notes", $this->order_notes, PDO::PARAM_STR);
            $st->bindValue(":order_total", $this->order_total, PDO::PARAM_INT);  // Changed to integer
            $st->bindValue(":order_status", $this->order_status, PDO::PARAM_STR);
            $st->bindValue(":order_created_at", $this->order_created_at, PDO::PARAM_STR);
            $st->bindValue(":order_id", $this->order_id, PDO::PARAM_INT);

            $st->execute();

            $conn = null;
        } catch (PDOException $e) {
            throw new Exception("Database Error: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception("General Error: " . $e->getMessage());
        }
    }
}
?>

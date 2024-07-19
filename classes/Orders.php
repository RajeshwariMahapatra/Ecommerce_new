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
     * @var string The payment method
     */
    public $payment_method = null;

    /**
     * @var string The shipping method
     */
    public $shipping_method = null;

    /**
     * @var string The order notes
     */
    public $order_notes = null;

    /**
     * @var float The order total
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
        if (isset($data['payment_method'])) $this->payment_method = $data['payment_method'];
        if (isset($data['shipping_method'])) $this->shipping_method = $data['shipping_method'];
        if (isset($data['order_notes'])) $this->order_notes = $data['order_notes'];
        if (isset($data['order_total'])) $this->order_total = (float) $data['order_total'];
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
     * Inserts the current Order object into the database, and sets its ID property.
     */
    public function insert()
{
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
            delivery_pin_code, billing_name, billing_address, billing_email, billing_phone, payment_method, shipping_method, 
            order_notes, order_total, order_status, order_created_at
        ) VALUES (
            :order_identity, :user_id, :delivery_address_line1, :delivery_address_line2, :delivery_city, :delivery_state_id, :delivery_country_id, 
            :delivery_pin_code, :billing_name, :billing_address, :billing_email, :billing_phone, :payment_method, :shipping_method, 
            :order_notes, :order_total, :order_status, :order_created_at
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
        $st->bindValue(":payment_method", $this->payment_method, PDO::PARAM_STR);
        $st->bindValue(":shipping_method", $this->shipping_method, PDO::PARAM_STR);
        $st->bindValue(":order_notes", $this->order_notes, PDO::PARAM_STR);
        $st->bindValue(":order_total", $this->order_total, PDO::PARAM_STR);
        $st->bindValue(":order_status", $this->order_status, PDO::PARAM_STR);
        $st->bindValue(":order_created_at", $this->order_created_at, PDO::PARAM_STR);
        $st->execute();
        $this->order_id = $conn->lastInsertId();
    } catch (PDOException $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

    /**
     * Updates the current Order object in the database.
     */
    public function update()
    {
        // Does the Order object have an ID?
        if (is_null($this->order_id)) {
            trigger_error("Orders::update(): Attempt to update an Order object that does not have its ID property set.", E_USER_ERROR);
        }

        // Update the Order
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE orders SET
            order_identity = :order_identity,
            user_id = :user_id,
            delivery_address_line1 = :delivery_address_line1,
            delivery_address_line2 = :delivery_address_line2,
            delivery_city = :delivery_city,
            delivery_state_id = :delivery_state_id,
            delivery_country_id = :delivery_country_id,
            delivery_pin_code = :delivery_pin_code,
            billing_name = :billing_name,
            billing_address = :billing_address,
            billing_email = :billing_email,
            billing_phone = :billing_phone,
            payment_method = :payment_method,
            shipping_method = :shipping_method,
            order_notes = :order_notes,
            order_total = :order_total,
            order_status = :order_status,
            order_created_at = :order_created_at
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
        $st->bindValue(":payment_method", $this->payment_method, PDO::PARAM_STR);
        $st->bindValue(":shipping_method", $this->shipping_method, PDO::PARAM_STR);
        $st->bindValue(":order_notes", $this->order_notes, PDO::PARAM_STR);
        $st->bindValue(":order_total", $this->order_total, PDO::PARAM_STR);
        $st->bindValue(":order_status", $this->order_status, PDO::PARAM_STR);
        $st->bindValue(":order_created_at", $this->order_created_at, PDO::PARAM_STR);
        $st->bindValue(":order_id", $this->order_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    /**
     * Deletes the current Order object from the database.
     */
    public function delete()
    {
        // Does the Order object have an ID?
        if (is_null($this->order_id)) {
            trigger_error("Orders::delete(): Attempt to delete an Order object that does not have its ID property set.", E_USER_ERROR);
        }

        // Delete the Order
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM orders WHERE order_id = :order_id LIMIT 1");
        $st->bindValue(":order_id", $this->order_id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }
}
?>

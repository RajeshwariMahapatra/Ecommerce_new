<?php
/**
 * Class to handle order items
 */
class OrderItems
{
    // Properties

    /**
     * @var int The order item ID from the database
     */
    public $order_item_id = null;

    /**
     * @var string The order item identity from the database
     */
    public $order_item_identity = null;

    /**
     * @var int The order ID from the Orders table
     */
    public $order_id = null;

    /**
     * @var int The product ID from the Products table
     */
    public $product_id = null;

    /**
     * @var string The product name
     */
    public $product_name = null;

    /**
     * @var float The product price
     */
    public $product_price = null;

    /**
     * @var int The quantity of the product
     */
    public $quantity = null;

    /**
     * @var float The subtotal for the order item
     */
    public $subtotal = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param array $data The property values
     */
    public function __construct($data = array())
    {
        if (isset($data['order_item_id'])) {
            $this->order_item_id = (int) $data['order_item_id'];
        }
        if (isset($data['order_item_identity'])) {
            $this->order_item_identity = $data['order_item_identity'];
        }
        if (isset($data['order_id'])) {
            $this->order_id = (int) $data['order_id'];
        }
        if (isset($data['product_id'])) {
            $this->product_id = (int) $data['product_id'];
        }
        if (isset($data['product_name'])) {
            $this->product_name = $data['product_name'];
        }
        if (isset($data['product_price'])) {
            $this->product_price = (float) $data['product_price'];
        }
        if (isset($data['quantity'])) {
            $this->quantity = (int) $data['quantity'];
        }
        if (isset($data['subtotal'])) {
            $this->subtotal = (float) $data['subtotal'];
        }
    }

    /**
 * Returns a list of OrderItems objects associated with a specific user ID
 *
 * @param int $user_id The user ID
 * @return array The order item objects, or an empty array if no items were found
 */
public static function getOrderItemsByUserId($userId) {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT 
                    o.order_id,
                    GROUP_CONCAT(oi.product_name SEPARATOR ', ') AS products,
                    GROUP_CONCAT(oi.product_price SEPARATOR ', ') AS prices,
                    GROUP_CONCAT(oi.quantity SEPARATOR ', ') AS quantities,
                    GROUP_CONCAT(oi.subtotal SEPARATOR ', ') AS subtotals,
                    o.order_created_at
                FROM OrderItems oi
                INNER JOIN Orders o ON oi.order_id = o.order_id
                WHERE o.user_id = :user_id
                GROUP BY o.order_id
                ORDER BY o.order_created_at DESC";
    $st = $conn->prepare($sql);
    $st->bindValue(":user_id", $userId, PDO::PARAM_INT);
    $st->execute();
    $orderItems = $st->fetchAll(PDO::FETCH_ASSOC); // Use associative array fetch style
    $conn = null;
    return $orderItems;
}

    /**
     * Inserts the current OrderItems object into the database, and sets its ID property.
     */
    public function insert()
{
    if (!is_null($this->order_item_id)) {
        trigger_error("OrderItems::insert(): Attempt to insert an OrderItem object that already has its ID property set (to $this->order_item_id).", E_USER_ERROR);
    }

    if (is_null($this->order_id)) {
        throw new Exception("OrderItems::insert(): order_id is not set.");
    }

    try {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO OrderItems (
            order_item_identity, order_id, product_id, product_name, product_price, quantity, subtotal
        ) VALUES (
            :order_item_identity, :order_id, :product_id, :product_name, :product_price, :quantity, :subtotal
        )";

        $st = $conn->prepare($sql);

        $st->bindValue(":order_item_identity", $this->order_item_identity, PDO::PARAM_STR);
        $st->bindValue(":order_id", $this->order_id, PDO::PARAM_INT);
        $st->bindValue(":product_id", $this->product_id, PDO::PARAM_INT);
        $st->bindValue(":product_name", $this->product_name, PDO::PARAM_STR);
        $st->bindValue(":product_price", $this->product_price, PDO::PARAM_STR);
        $st->bindValue(":quantity", $this->quantity, PDO::PARAM_INT);
        $st->bindValue(":subtotal", $this->subtotal, PDO::PARAM_STR);

        // Debug output
        error_log("Inserting OrderItem with ID: " . $this->order_item_identity);

        $st->execute();
        $this->order_item_id = $conn->lastInsertId();

    } catch (PDOException $e) {
        throw new Exception("Database error: " . $e->getMessage());
    } catch (Exception $e) {
        throw new Exception("Error: " . $e->getMessage());
    }
}

    /**
     * Updates the current OrderItems object in the database.
     */
    public function update()
    {
        // Does the OrderItems object have an ID?
        if (is_null($this->order_item_id)) {
            trigger_error("OrderItems::update(): Attempt to update an OrderItem object that does not have its ID property set.", E_USER_ERROR);
        }

        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE OrderItems SET
                order_item_identity = :order_item_identity,
                order_id = :order_id,
                product_id = :product_id,
                product_name = :product_name,
                product_price = :product_price,
                quantity = :quantity,
                subtotal = :subtotal
                WHERE order_item_id = :order_item_id";

            $st = $conn->prepare($sql);
            $st->bindValue(":order_item_identity", $this->order_item_identity, PDO::PARAM_STR);
            $st->bindValue(":order_id", $this->order_id, PDO::PARAM_INT);
            $st->bindValue(":product_id", $this->product_id, PDO::PARAM_INT);
            $st->bindValue(":product_name", $this->product_name, PDO::PARAM_STR);
            $st->bindValue(":product_price", $this->product_price, PDO::PARAM_STR);
            $st->bindValue(":quantity", $this->quantity, PDO::PARAM_INT);
            $st->bindValue(":subtotal", $this->subtotal, PDO::PARAM_STR);
            $st->bindValue(":order_item_id", $this->order_item_id, PDO::PARAM_INT);
            $st->execute();
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    /**
     * Deletes the current OrderItems object from the database.
     */
    public function delete()
    {
        // Does the OrderItems object have an ID?
        if (is_null($this->order_item_id)) {
            trigger_error("OrderItems::delete(): Attempt to delete an OrderItem object that does not have its ID property set.", E_USER_ERROR);
        }

        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $st = $conn->prepare("DELETE FROM OrderItems WHERE order_item_id = :order_item_id LIMIT 1");
            $st->bindValue(":order_item_id", $this->order_item_id, PDO::PARAM_INT);
            $st->execute();
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    /**
     * Returns a list of OrderItems objects associated with a specific order ID
     *
     * @param int $order_id The order ID
     * @return array The order item objects, or an empty array if no items were found
     */
    public static function getByOrderId($order_id)
    {
        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM OrderItems WHERE order_id = :order_id";
            $st = $conn->prepare($sql);
            $st->bindValue(":order_id", $order_id, PDO::PARAM_INT);
            $st->execute();

            $items = array();
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                $items[] = new OrderItems($row);
            }

            return $items;
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    /**
     * Fetches order details from checkout page cookies and stores them in the OrderItems table.
     *
     * @param int $orderId The ID of the order to associate the items with
     */
    public static function storeItemsFromCookies($orderId)
{
    // Ensure the cart is loaded from cookies
    if (isset($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);

        foreach ($cart as $cartItem) {
            $orderItem = new OrderItems();
            $orderItem->order_id = $orderId;  // This should not be null
            $orderItem->product_id = $cartItem['id'];
            $orderItem->product_name = $cartItem['name'];
            $orderItem->product_price = $cartItem['price'];
            $orderItem->quantity = $cartItem['quantity'];
            $orderItem->subtotal = $cartItem['price'] * $cartItem['quantity'];

            // Debugging: Check the values before inserting
            var_dump($orderItem);

            $orderItem->insert();
        }
    } else {
        trigger_error("OrderItems::storeItemsFromCookies(): No cart data found in cookies.", E_USER_ERROR);
    }
}
}
?>

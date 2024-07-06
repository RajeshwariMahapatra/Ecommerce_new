<?php
/**
 * Class to handle pages
 */
class Pages
{
  // Properties

  /**
   * @var int The page ID from the database
   */
  public $page_id = null;
  /**
   * @var int The page ID from the database
   */
  public $page_identity = null;

  /**
   * @var string The heading of the page
   */
  public $page_heading = null;

  /**
   * @var string The subheading of the page
   */
  public $page_subheading = null;

  /**
   * @var string The cover image of the page
   */
  public $page_coverimage = null;

  /**
   * @var string The content of the page
   */
  public $page_content = null;

  /**
   * @var int The preference of the page
   */
  public $page_preference = null;

  /**
   * @var int Indicates if the page is on the navbar
   */
  public $page_on_navbar = null;

  /**
   * @var string The creation date of the page
   */
  public $page_created_at = null;

  /**
   * Sets the object's properties using the values in the supplied array
   *
   * @param array $data The property values
   */

  public function __construct($data = array())
  {
    if (isset($data['page_id'])) $this->page_id = (int) $data['page_id'];
    if (isset($data['page_identity'])) $this->page_identity = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['page_identity']);
    if (isset($data['page_heading'])) $this->page_heading = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['page_heading']);
    if (isset($data['page_subheading'])) $this->page_subheading = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['page_subheading']);
    if (isset($data['page_coverimage'])) $this->page_coverimage = $data['page_coverimage'];
    if (isset($data['page_content'])) $this->page_content =  $data['page_content'];
    if (isset($data['page_preference'])) $this->page_preference = (int) $data['page_preference'];
    if (isset($data['page_on_navbar'])) $this->page_on_navbar = (int) $data['page_on_navbar'];
    if (isset($data['page_created_at'])) $this->page_created_at = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['page_created_at']);
  }


  /**
   * Sets the object's properties using the form post values in the supplied array
   *
   * @param array $params The form post values
   */
  public function storeFormValues($params)
  {
    // Store all the parameters
    $this->__construct($params);
  }

  /**
   * Returns a Pages object matching the given page ID
   *
   * @param int $page_id The page ID
   * @return Pages|false The page object, or false if the record was not found or there was a problem
   */
  public static function getById($page_id)
  {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT * FROM Pages WHERE page_id = :page_id";
    $st = $conn->prepare($sql);
    $st->bindValue(":page_id", $page_id, PDO::PARAM_INT);
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ($row) return new Pages($row);
    return false;
  }

  /**
   * Returns all (or a range of) Pages objects in the DB
   *
   * @param int $numRows Optional The number of rows to return (default=all)
   * @return array|false A two-element array: results => array, a list of Pages objects; totalRows => Total number of pages
   */
  public static function getList($numRows = 1000000)
  {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM Pages ORDER BY page_id DESC LIMIT :numRows";
    $st = $conn->prepare($sql);
    $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
    $st->execute();
    $list = array();

    while ($row = $st->fetch()) {
      $page = new Pages($row);
      $list[] = $page;
    }

    // Now get the total number of pages that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query($sql)->fetch();
    $conn = null;
    return array("results" => $list, "totalRows" => $totalRows[0]);
  }

  /**
   * Inserts the current Pages object into the database, and sets its ID property.
   */
  public function insert()
  {
    // Does the Pages object already have an ID?
    if (!is_null($this->page_id)) trigger_error("Pages::insert(): Attempt to insert a Pages object that already has its ID property set (to $this->page_id).", E_USER_ERROR);

    $encoded_content = htmlspecialchars($this->page_content, ENT_QUOTES, 'UTF-8');

    // Insert the Pages
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "INSERT INTO Pages (page_identity, page_heading, page_subheading, page_coverimage, page_content, page_preference, page_on_navbar, page_created_at) VALUES (:page_identity,:page_heading, :page_subheading, :page_coverimage, :page_content, :page_preference, :page_on_navbar, :page_created_at)";
    $st = $conn->prepare($sql);
    $st->bindValue(":page_identity", $this->page_identity, PDO::PARAM_STR);
    $st->bindValue(":page_heading", $this->page_heading, PDO::PARAM_STR);
    $st->bindValue(":page_subheading", $this->page_subheading, PDO::PARAM_STR);
    $st->bindValue(":page_coverimage", $this->page_coverimage, PDO::PARAM_STR);
    $st->bindValue(":page_content", $encoded_content, PDO::PARAM_STR);
    $st->bindValue(":page_preference", $this->page_preference, PDO::PARAM_INT);
    $st->bindValue(":page_on_navbar", $this->page_on_navbar, PDO::PARAM_INT);
    $st->bindValue(":page_created_at", $this->page_created_at, PDO::PARAM_STR);
    $st->execute();
    $this->page_id = $conn->lastInsertId();
    $conn = null;
  }


  public function storeUploadedCoverImage($image)
  {
    
    if (isset($image) && $image['error'] == UPLOAD_ERR_OK) {
      
      $this->deleteCoverImage();
      // Generate a unique name for the image file
      $uniqueName = uniqid() . strtolower(strrchr($image['name'], '.'));

      // Define the image path and URL
      $imagePath = COVER_IMAGE_PATH . $uniqueName;
      $imageURL = COVER_IMAGE_URL . $uniqueName;

      // Store the image
      $tempFilename = trim($image['tmp_name']);

      if (is_uploaded_file($tempFilename)) {
        if (!(move_uploaded_file($tempFilename, $imagePath))) {
          trigger_error("Page::storeUploadedCoverImage(): Couldn't move uploaded file.", E_USER_ERROR);
        }
        if (!(chmod($imagePath, 0666))) {
          trigger_error("Page::storeUploadedCoverImage(): Couldn't set permissions on uploaded file.", E_USER_ERROR);
        }
      }

      // Save the image URL to the property
      $this->{"page_coverimage"} = $imageURL;

      // Update the database if page_id is set (i.e., updating an existing page)
      if ($this->page_id) {
        $this->update();
      }
    }
  }


  public function deleteCoverImage()
  {
    // Function to delete the existing cover image if needed
    if ($this->page_coverimage) {
      $imagePath = COVER_IMAGE_PATH . basename($this->page_coverimage);
      if (file_exists($imagePath)) {
        unlink($imagePath);
      }
      $this->page_coverimage = null;
    }
  }

  /**
   * Updates the current Pages object in the database.
   */
  public function update()
  {
    // Does the Pages object have an ID?
    if (is_null($this->page_id)) trigger_error("Pages::update(): Attempt to update a Pages object that does not have its ID property set.", E_USER_ERROR);

    $encoded_content = htmlspecialchars($this->page_content, ENT_QUOTES, 'UTF-8');

    // Update the Pages
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "UPDATE Pages SET page_identity=:page_identity,page_heading=:page_heading, page_subheading=:page_subheading, page_coverimage=:page_coverimage, page_content=:page_content, page_preference=:page_preference, page_on_navbar=:page_on_navbar, page_created_at=:page_created_at WHERE page_id = :page_id";
    $st = $conn->prepare($sql);
    $st->bindValue(":page_identity", $this->page_identity, PDO::PARAM_STR);
    $st->bindValue(":page_heading", $this->page_heading, PDO::PARAM_STR);
    $st->bindValue(":page_subheading", $this->page_subheading, PDO::PARAM_STR);
    $st->bindValue(":page_coverimage", $this->page_coverimage, PDO::PARAM_STR);
    $st->bindValue(":page_content", $encoded_content, PDO::PARAM_STR);
    $st->bindValue(":page_preference", $this->page_preference, PDO::PARAM_INT);
    $st->bindValue(":page_on_navbar", $this->page_on_navbar, PDO::PARAM_INT);
    $st->bindValue(":page_created_at", $this->page_created_at, PDO::PARAM_STR);
    $st->bindValue(":page_id", $this->page_id, PDO::PARAM_INT);
    $st->execute();
    $conn = null;
  }

  /**
   * Deletes the current Pages object from the database.
   */
  public function delete()
  {
    // Does the Pages object have an ID?
    if (is_null($this->page_id)) trigger_error("Pages::delete(): Attempt to delete a Pages object that does not have its ID property set.", E_USER_ERROR);

    // Delete the Pages
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $st = $conn->prepare("DELETE FROM Pages WHERE page_id = :page_id LIMIT 1");
    $st->bindValue(":page_id", $this->page_id, PDO::PARAM_INT);
    $st->execute();
    $conn = null;
  }
}

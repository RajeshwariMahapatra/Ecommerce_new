CREATE TABLE State(
    state_id INT(11) NOT NULL AUTO_INCREMENT,
    state_identity VARCHAR(12) NOT NULL UNIQUE,
    state_name VARCHAR(50),
    state_gst_code VARCHAR(10),
    PRIMARY KEY (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Country(
    country_id INT(11) NOT NULL AUTO_INCREMENT,
    country_identity VARCHAR(12) NOT NULL UNIQUE,
    country_name VARCHAR(255) NOT NULL,
    country_code VARCHAR(5) NOT NULL,
    country_currency VARCHAR(10) NOT NULL,
    country_language VARCHAR(20) NOT NULL,
    PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Users (
    user_id INT(11) NOT NULL AUTO_INCREMENT,
    user_identity VARCHAR(12) NOT NULL UNIQUE,
    user_name VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL UNIQUE,
    user_country_code VARCHAR(5),
    user_contact_no VARCHAR(11) NOT NULL UNIQUE,
    user_address_line1 VARCHAR(255) NOT NULL,
    user_address_line2 VARCHAR(255) NOT NULL,
    user_address_city VARCHAR(50) NOT NULL,
    user_address_state_id INT(11),
    user_address_country_id INT(11),
    user_address_pin_code VARCHAR(6) NOT NULL,
    user_created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
    user_birthdate DATE NOT NULL,
    user_status  BOOLEAN,
PRIMARY KEY (`user_id`),
FOREIGN KEY (user_address_state_id) REFERENCES State(state_id),
FOREIGN KEY (user_address_country_id) REFERENCES Country(country_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `brand` (
  `brand_id` INT(11) NOT NULL AUTO_INCREMENT,
  `brand_identity` VARCHAR(12) DEFAULT NULL,
  `brand_name` VARCHAR(255) DEFAULT NULL,
  `brand_created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pages` (
  `page_id` INT(11) NOT NULL AUTO_INCREMENT,
  `page_identity` VARCHAR(12) DEFAULT NULL,
  `page_heading` VARCHAR(255) DEFAULT NULL,
  `page_subheading` VARCHAR(255) DEFAULT NULL,
  `page_coverimage` VARCHAR(255) DEFAULT NULL,
  `page_content` TEXT DEFAULT NULL,
  `page_preference` INT(11) DEFAULT NULL,
  `page_on_navbar` TINYINT(1) DEFAULT NULL,
  `page_created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `productcategory` (
  `category_id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_identity` VARCHAR(12) DEFAULT NULL,
  `category_name` VARCHAR(255) DEFAULT NULL,
  `category_description` TEXT DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `product` (
  `product_id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_identity` VARCHAR(12) DEFAULT NULL,
  `product_category_id` INT(11) DEFAULT NULL,
  `product_brand_id` INT(11) DEFAULT NULL,
  `product_mrp` DECIMAL(10,2) DEFAULT NULL,
  `product_selling_price` DECIMAL(10,2) DEFAULT NULL,
  `product_name` VARCHAR(255) DEFAULT NULL,
  `product_desc` TEXT DEFAULT NULL,
  `product_small_desc` TEXT DEFAULT NULL,
  `product_stock` INT(11) DEFAULT NULL,
  `product_product_image_1` VARCHAR(255) DEFAULT NULL,
  `product_product_image_2` VARCHAR(255) DEFAULT NULL,
  `product_product_image_3` VARCHAR(255) DEFAULT NULL,
  `product_shipping_time_est` INT(11) DEFAULT NULL,
  `product_breadth` DECIMAL(10,2) DEFAULT NULL,
  `product_volume` DECIMAL(10,2) DEFAULT NULL,
  `product_height` DECIMAL(10,2) DEFAULT NULL,
  `product_weight` DECIMAL(10,2) DEFAULT NULL,
  `product_tags` TEXT DEFAULT NULL,
  `product_tax` INT(11) DEFAULT NULL,
  `product_hsn_code` VARCHAR(50) DEFAULT NULL,
  `product_certification` TEXT DEFAULT NULL,
  `product_barcode` VARCHAR(20) DEFAULT NULL,
  `product_sku` VARCHAR(50) DEFAULT NULL,
  `product_code` VARCHAR(50) DEFAULT NULL,
  `product_warranty` TEXT DEFAULT NULL,
  `product_guarantee` TEXT DEFAULT NULL,
  `product_offer_code` VARCHAR(12) DEFAULT NULL,
  `product_features` TEXT DEFAULT NULL,
  `product_created_on` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  `product_updated_on` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_id`),
  FOREIGN KEY (`product_category_id`) REFERENCES `productcategory`(`category_id`),
  FOREIGN KEY (`product_brand_id`) REFERENCES `brand`(`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


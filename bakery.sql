CREATE DATABASE bakery_management;

USE bakery_management;-- 

CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  is_admin TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE customers (
customer_id INT PRIMARY KEY auto_increment,
customer_name VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
phone_number VARCHAR(20) NOT NULL,
address VARCHAR(255) NOT NULL
);

CREATE TABLE products (
product_id INT PRIMARY KEY auto_increment,
product_name VARCHAR(255) NOT NULL,
description VARCHAR(255),
price DECIMAL(10,2) NOT NULL,
stock_quantity INT NOT NULL,
expiry_date DATE,
category_id INT NOT NULL,
FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE TABLE invoices (	
  invoice_id INT PRIMARY KEY auto_increment,
  customer_id INT NOT NULL,
  invoice_date DATE NOT NULL,
  total_amount DECIMAL(10,2) NOT NULL,
  payment_status VARCHAR(20) NOT NULL,
  payment_date DATE,
  FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

CREATE TABLE categories (
category_id INT PRIMARY KEY auto_increment,
category_name VARCHAR(255) NOT NULL
);

CREATE TABLE orders (
order_id INT PRIMARY KEY auto_increment,
customer_id INT NOT NULL,
order_date DATE NOT NULL,
total_price DECIMAL(10,2) NOT NULL,
payment_method VARCHAR(50) NOT NULL,
FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);


CREATE TABLE order_items (
order_item_id INT PRIMARY KEY auto_increment,
order_id INT NOT NULL,
product_id INT NOT NULL,
quantity INT NOT NULL,
FOREIGN KEY (order_id) REFERENCES orders(order_id),
FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE product_updates (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_by VARCHAR(255),
  update_reason VARCHAR(255),
  old_product_name VARCHAR(255),
  new_product_name VARCHAR(255),
  old_price DECIMAL(10,2),
  new_price DECIMAL(10,2),
  old_description TEXT,
  new_description TEXT,
  old_stock_quantity INT,
  new_stock_quantity INT,
  old_expiry_date DATE,
  new_expiry_date DATE,
  old_category_id INT,
  new_category_id INT
);

DELIMITER #
CREATE PROCEDURE add_product(
  IN name VARCHAR(50),
  IN quantity INT,
  IN price DECIMAL(10, 2),
  IN description VARCHAR(50),
  IN expiry_date DATE,
  IN category_id INT
)
BEGIN
  INSERT INTO products (product_name, description, price, stock_quantity, expiry_date, category_id)
  VALUES (name, description, price, quantity, expiry_date, category_id);
END #

CREATE TRIGGER product_update_trigger
AFTER UPDATE ON products
FOR EACH ROW
BEGIN
  INSERT INTO product_updates (product_id, updated_by, old_product_name, new_product_name, old_price, new_price, old_description, new_description, old_stock_quantity, new_stock_quantity, old_expiry_date, new_expiry_date, old_category_id, new_category_id)
  VALUES (NEW.product_id, CURRENT_USER(), OLD.product_name, NEW.product_name, OLD.price, NEW.price, OLD.description, NEW.description, OLD.stock_quantity, NEW.stock_quantity, OLD.expiry_date, NEW.expiry_date, OLD.category_id, NEW.category_id);
END #


DELIMITER ;








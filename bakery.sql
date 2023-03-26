CREATE DATABASE bakery_management;

USE bakery_management;

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

DELIMITER ;




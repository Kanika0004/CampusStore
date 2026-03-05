CREATE DATABASE IF NOT EXISTS campusstore;
USE campusstore;

-- USERS
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
email VARCHAR(100) UNIQUE,
password VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- PRODUCTS
CREATE TABLE products (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
price DECIMAL(10,2),
image VARCHAR(255)
);

-- CART
CREATE TABLE cart (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
product_id INT,
quantity INT DEFAULT 1
);

-- ADDRESSES
CREATE TABLE addresses (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
first_name VARCHAR(50),
last_name VARCHAR(50),
email VARCHAR(100),
address TEXT,
landmark VARCHAR(100),
country VARCHAR(50),
state VARCHAR(50),
zip VARCHAR(20)
);

-- ORDERS
CREATE TABLE orders (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
total DECIMAL(10,2),
payment_method VARCHAR(50),
address TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO products (name, price, image) VALUES
('Wireless Mouse', 599, 'mouse.jpg'),
('Notebook Set', 299, 'notebooks.jpg'),
('Bluetooth Earbuds', 1499, 'earbuds.jpg'),
('Campus Hoodie', 899, 'hoodie.jpg');
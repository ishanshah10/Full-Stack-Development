--  Create Database
CREATE DATABASE inventory_db;
USE inventory_db;

--  Suppliers Table
CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(50),
    location VARCHAR(100)
);

--  Users Table (Admin & User)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') NOT NULL
);

--  Products Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    supplier_id INT,
    price DECIMAL(10,2),
    stock INT,
    added_by INT,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),
    FOREIGN KEY (added_by) REFERENCES users(id)
);

--  Insert Default Admin and User Accounts
INSERT INTO users (username, password, role) VALUES
('admin', MD5('admin123'), 'admin'),
('user1', MD5('user123'), 'user');

-- 6. Insert Sample Suppliers
INSERT INTO suppliers (name, email, phone, location) VALUES
('Local Supplier','local@gmail.com','9800000000','Kathmandu'),
('Global Traders','global@gmail.com','9811111111','Pokhara'),
('Warehouse Hub','warehouse@gmail.com','9822222222','Lalitpur');

--  Insert Sample Products (added by admin)
INSERT INTO products (product_name, supplier_id, price, stock, added_by) VALUES
('Laptop', 1, 1200.00, 5, 1),
('Mouse', 2, 15.00, 50, 1),
('Keyboard', 3, 25.00, 8, 1);

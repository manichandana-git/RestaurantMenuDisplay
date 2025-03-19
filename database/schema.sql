CREATE DATABASE restaurant_db;
USE restaurant_db;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Menu Items Table
CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL
);

-- Sample Menu Items
INSERT INTO menu_items (name, description, price, category) VALUES
('Burger', 'Delicious grilled burger', 5.99, 'Fast Food'),
('Pizza', 'Cheesy pepperoni pizza', 8.99, 'Italian'),
('Pasta', 'Creamy Alfredo pasta', 7.99, 'Italian');

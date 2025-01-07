<?php
include('db_connection.php');

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS user_database";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully\n";
} else {
  echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("user_database");

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
)";
if ($conn->query($sql) === TRUE) {
  echo "Table users created successfully\n";
} else {
  echo "Error creating table users: " . $conn->error;
}

// Create products table
$sql = "CREATE TABLE IF NOT EXISTS products (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (id)
)";
if ($conn->query($sql) === TRUE) {
  echo "Table products created successfully\n";
} else {
  echo "Error creating table products: " . $conn->error;
}

//Add Products
$sql = "INSERT INTO products (name, description, price) VALUES
  ('Smartphone', 'A high-end smartphone with a powerful processor and stunning display.', 699.99),
  ('Laptop', 'A sleek and lightweight laptop perfect for work and play.', 999.99),
  ('Smart TV', 'A 55-inch smart TV with 4K resolution and built-in streaming apps.', 599.99),
  ('Wireless Headphones', 'Noise-canceling wireless headphones with long battery life.', 199.99),
  ('Smartwatch', 'A stylish smartwatch with fitness tracking and notifications.', 249.99),
  ('Bluetooth Speaker', 'A portable Bluetooth speaker with excellent sound quality.', 129.99),
  ('Gaming Console', 'A next-gen gaming console with a vast library of games.', 499.99),
  ('Tablet', 'A versatile tablet with a large display and high performance.', 299.99),
  ('Digital Camera', 'A compact digital camera with impressive zoom and image quality.', 349.99),
  ('E-Reader', 'A lightweight e-reader with a glare-free screen and long battery life.', 119.99);
";

$conn->close();
?>

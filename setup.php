<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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

$conn->close();
?>

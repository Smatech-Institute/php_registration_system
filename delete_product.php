<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  $message = "Product deleted successfully!";
} else {
  $message = "Error deleting product: " . $conn->error;
}

$conn->close();
header("Location: dashboard.php");
exit();
?>

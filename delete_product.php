<?php
$conn->select_db("user_database");
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];

$conn->select_db("user_database");
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

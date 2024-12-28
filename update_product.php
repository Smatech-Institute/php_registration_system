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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  $sql = "UPDATE products SET ";
  $updates = [];

  if (!empty($name)) {
    $updates[] = "name='$name'";
  }
  if (!empty($description)) {
    $updates[] = "description='$description'";
  }
  if (!empty($price)) {
    $updates[] = "price='$price'";
  }

  if (!empty($updates)) {
    $sql .= implode(", ", $updates) . " WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
      $message = "Product updated successfully!";
    } else {
      $message = "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    $message = "No fields to update!";
  }
} else {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $product = $result->fetch_assoc();
    } else {
      $message = "Product not found!";
    }
  } else {
    $message = "Invalid product ID!";
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Product</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2 class="mt-5">Update Product</h2>
    <?php if (!empty($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
    <?php if (isset($product)) { ?>
    <form method="POST" action="update_product.php" class="mt-3">
      <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
      <div class="form-group">
        <label for="name">Product Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description"><?php echo $product['description']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>">
      </div>
      <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
    <?php } ?>
    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
  </div>
</body>
</html>

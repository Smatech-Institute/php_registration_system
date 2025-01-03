<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "user_database";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";

  if ($conn->query($sql) === TRUE) {
    $message = "Product created successfully!";
  } else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Product</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2 class="mt-5">Create Product</h2>
    <?php if (!empty($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
    <form method="POST" action="create_product.php" class="mt-3">
      <div class="form-group">
        <label for="name">Product Name:</label>
        <input type="text" class="form-control" name="name" required>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" required></textarea>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" step="0.01" class="form-control" name="price" required>
      </div>
      <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
  </div>
</body>
</html>

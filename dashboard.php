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

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2 class="mt-5">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p>This is your dashboard.</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>

    <h3 class="mt-5">Products</h3>
    <table class="table table-bordered mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['description']}</td>
              <td>{$row['price']}</td>
              <td>
                <a href='update_product.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                <a href='delete_product.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
              </td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No products found</td></tr>";
        }
        ?>
      </tbody>
    </table>
    <a href="create_product.php" class="btn btn-primary mt-3">Create Product</a>
  </div>
</body>
</html>

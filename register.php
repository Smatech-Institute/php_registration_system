<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "user_database";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $user = $_POST['username'];
  $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $email = $_POST['email'];

  $sql = "INSERT INTO users (username, password, email) VALUES ('$user', '$pass', '$email')";

  if ($conn->query($sql) === TRUE) {
    $message = "Registration successful!";
    header("Location: login.php");
    exit();
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
  <title>Registration</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2 class="mt-5">Registration</h2>
    <?php if (!empty($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
    <form method="POST" action="register.php" class="mt-3">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>
</body>
</html>

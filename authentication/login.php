<?php
session_start();
include("../database/connection.php");

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  // Collect input values safely
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');
  $u_type = $_POST['u_type'] ?? '';


  if (empty($username)) {
    $message = "Username is Empty";
  } elseif (empty($password)) {
    $message = "Password is Empty";
  } elseif (empty($u_type)) {
    $message = "Select User Type";
  } else {

    $sql = "SELECT id, u_name, u_password, u_type FROM user WHERE u_name = '$username'";


      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['u_password']) && $u_type === $user['u_type']) {
          $_SESSION["id"] = $user['id'];
          $_SESSION["username"] = $user['u_name'];

          if ($u_type === "User") {
            header("Location: ../user_section/home.php");
          } else {
            header("Location: ../admin_section/home.php");
          }

          exit;
        }
      } else {
        $message = "Username does not exist.";
      }
    
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
  <header class="nav_bar">
    <h1><a href="../index.php">Online Bakery</a></h1>
    <ul class="nav_list">
      <li><a href="../index.php">Home</a></li>
      <li><a href="register.php">Register</a></li>
      <li><a href="#">Login</a></li>
    </ul>
  </header>

  <div class="register_main">
    <div>
      <h1 class="title">Login Page (User/Admin)</h1>
    </div>
    <div class="register_form">
      <form action="login.php" method="post">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter unique username"/>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter passowrd" />

        <div class="radio_group">
          <label><input type="radio" name="u_type" value="User" />User
          </label>

          <label><input type="radio" name="u_type" value="Admin" />Admin
          </label>
        </div>

        <input type="submit" name="submit" value="Login" />
      </form>
      <p style="color: #ffc46b; text-align: center; font-size: 1.1em;">
        <?php
        echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        ?>
      </p>
      <br />
      <hr />
      <br />

      <p class="text">
        <a href="register.php" class="login-link">Need an account? - Register</a>
      </p>
    </div>
  </div>

  <footer class="footer">
    <hr><br>Develop by : E116448 | Senesh Nagoda Vithana
  </footer>
</body>

</html>
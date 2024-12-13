<?php
include("../database/connection.php");

// variables
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  // Collect input values safely
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');
  $re_password = trim($_POST['re-password'] ?? '');
  $u_type = $_POST['u_type'] ?? '';


  if (empty($username)) {
    $message = "Username is Empty";
  } elseif (empty($password)) {
    $message = "Password is Empty";
  } elseif (empty($re_password)) {
    $message = "Re-password is Empty";
  } elseif (empty($u_type)) {
    $message = "Select User Type";
  }

  if ($password !== $re_password) {
    $message = "Wrong password";
  } else {
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "insert into user (u_name, u_password, u_type) values ('$username','$hash_password','$u_type')";

        $result = mysqli_query($conn, $sql);
  
        if ($result) {
          $message = "Create Account Successfully...!";
        } else {
          $message = "Incorrect";
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
      <li><a href="#">Register</a></li>
      <li><a href="login.php">Login</a></li>
    </ul>
  </header>

  <div class="register_main">
    <div>
      <h1 class="title">Register Page (User/Admin)</h1>
    </div>
    <div class="register_form">
      <form action="register.php" method="post">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter unique username"/>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter passowrd"/>

        <label>Confirm Password</label>
        <input type="password" name="re-password" placeholder="Enter re-enter password"/>

        <div class="radio_group">
          <label><input type="radio" name="u_type" value="User" />User
          </label>

          <label><input type="radio" name="u_type" value="Admin" />Admin
          </label>
        </div>

        <input type="submit" name="submit" value="Create Account" />
      </form>
      <p style="color: #ffc46b; text-align:center; font-size: 1em;">
        <?php
        echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        ?>
      </p><br />
      <hr /><br />

      <p class="text">
        <a href="login.php" class="login-link">Have an account? - Login</a>
      </p>
    </div>
  </div>

  <footer class="footer">
  <hr><br>Develop by : E116448 | Senesh Nagoda Vithana
  </footer>
</body>

</html>
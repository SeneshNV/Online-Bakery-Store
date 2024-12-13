<?php
session_start();
include("../database/connection.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../authentication/login.php");
    exit();
}

// variables
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = $_POST['name'] ?? "";
    $address = $_POST['address'] ?? "";
    $tel_no = $_POST['tel_no'] ?? "";
    $email = $_POST['email'] ?? "";

    if (empty($name)) {
        $message = "Please enter your name";
    } elseif (empty($address)) {
        $message = "Please enter home address";
    } elseif (empty($tel_no)) {
        $message = "Please enter Contact Number";
    } elseif (empty($email)) {
        $message = "Please enter email address";
    } else {

        $sql = "INSERT INTO bakery(b_name, b_description, b_price, b_qty, b_category) VALUES ('$name','$description','$price','$quantity', '$b_category')";

        
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $message = "Bakery add successfully";
            }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Checkout</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div>
        <?php
        include("header.php");
        ?>
    </div>

    <div class="register_main">
        <div>
            <h1 class="title">Checkout Item</h1>
        </div>

        <div class="register_form">
            <form action="checkout.php" method="post">
                
                <label>Your Name</label>
                <input type="text" name="name" />

                <label>Home address</label>
                <input type="text" name="address" />
                
                <label>Contact Number</label>
                <input type="number" name="tel_no" />
                
                <label>Email</label>
                <input type="email" name="email" />

                <input type="submit" name="submit" value="Submit Order" />
            </form>
            <p style="color: #ffc46b; text-align:center; font-size: 1em;">
                <?php
                echo $message;
                ?>
            </p><br />
            <hr /><br />

        </div>
    </div>
    <footer class="footer">
    <hr><br>Develop by : E116448 | Senesh Nagoda Vithana
  </footer>
</body>

</html>
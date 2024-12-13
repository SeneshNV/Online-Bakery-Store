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
    $description = $_POST['description'] ?? "";
    $price = $_POST['price'] ?? "";
    $quantity = $_POST['quantity'] ?? "";
    $b_category = $_POST['b_category'] ?? "";

    if (empty($name)) {
        $message = "Please enter Bakery item name";
    } elseif (empty($description)) {
        $message = "Please enter description";
    } elseif (empty($price)) {
        $message = "Please enter price";
    } elseif (empty($quantity)) {
        $message = "Please enter quantity";
    } elseif (empty($b_category)) {
        $message = "Please enter category";
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
    <title>Admin - Home</title>
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
            <h1 class="title">Add Bakery Item</h1>
        </div>

        <div class="register_form">
            <form action="home.php" method="post">
                
                <label>Item Name</label>
                <input type="text" name="name" />

                <label>Description</label>
                <input type="text" name="description" />
                
                <label>Price</label>
                <input type="number" name="price" />
                
                <label>Quantity</label>
                <input type="number" name="quantity" />
                
                <label>Category</label>
                <input type="text" name="b_category" />

                <input type="submit" name="submit" value="Add Bakery Item" />
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
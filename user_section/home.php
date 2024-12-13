<?php
include("../database/connection.php");
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: ../authentication/login.php");
    exit();
}

$u_id = $_SESSION["id"];

// variables
$message = "";

if (isset($_GET['cart_id'])) {
    $cart_id = intval($_GET['cart_id']);
    $sql = "INSERT INTO `cart`(`u_id`, `b_id`) VALUES ('$u_id','$cart_id')";



        $result = mysqli_query($conn, $sql);

        if ($result) {
            $message = "Add to cart successfully...!";
        } else {
            $message = "Incorrect";
        }
    
}

$sql = "SELECT * FROM bakery";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Home</title>
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
            <h1 class="title">View Bakery Items</h1>
        </div>

        <div class="view_bakery">
            <table border="1">
                <thead>
                    <tr>
                        
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['b_name'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_description'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_price'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_qty'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_category'])  . "</td>";
                            echo "<td>";
                            echo "<a href='home.php?cart_id=" . $row['b_id'] . "'>Add to Cart</a>";
                            echo "</td>";
                        }
                    }

                    ?>
                </tbody>

            </table>
        </div>
    </div>
    <footer class="footer">
    <hr><br>Develop by : E116448 | Senesh Nagoda Vithana
  </footer>
</body>

</html>
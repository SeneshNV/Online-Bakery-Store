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

$sql = "SELECT bakery.b_id, bakery.b_name, bakery.b_description, bakery.b_price, bakery.b_category
FROM cart
INNER JOIN bakery
ON cart.b_id = bakery.b_id
WHERE cart.u_id = '$u_id'";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
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
            <h1 class="title">View Bakery Cart</h1>
        </div>

        <div class="view_bakery">
            <table border="1">
                <thead>
                    <tr>
                        <th>Bakery Item Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['b_name'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_description'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_category'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_price'])  . "</td>";
                            echo "<td>";
                            echo "<a href='checkout.php?cart_id=" . $row['b_id'] . "'>Checkout Item</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Your cart is empty</td></tr>";
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
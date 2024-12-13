<?php
include("../database/connection.php");
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: ../authentication/login.php");
    exit();
}

// variables
$message = "";

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql = "DELETE FROM bakery WHERE b_id = $delete_id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: view_bakery.php");
        exit();
    } else {
        $message = "Error deleting record";
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
    <title>Document</title>
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
            <h1 class="title">Manage Bakery item List</h1>
        </div>

        <div class="view_bakery">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
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
                            echo "<td>" . htmlspecialchars($row['b_id'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_name'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_description'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_price'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_qty'])  . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_category'])  . "</td>";
                            echo "<td>";
                            echo "<a href='view_bakery.php?delete_id=" . $row['b_id'] . "'>Delete</a>";
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
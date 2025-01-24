<?php

// Start session
session_start();

include('../Model/db_connect.php'); 

// Check if the session is active and the user is logged in as admin
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login/loginFormAdmin.php");
    exit();
}

// Set a cookie to remember the user 
setcookie("user_email", $_SESSION['email'], time() + (86400 * 30), "/"); // 30-day cookie


$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

// SQL query to filter by Product ID or Name
$sql = "SELECT * FROM products WHERE productID LIKE '%$searchQuery%' OR name LIKE '%$searchQuery%'";
$result = $conn->query($sql);

// Handle logout action
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../Login/Multi_login_page.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="inventory.css">
</head>
<body>
    <header>
        <div class="header-title">Inventory</div>
        <div class="header-right">
            <span>Welcome, Admin</span>
            <form method="POST" style="display:inline;">
                    <button type="submit" name="logout" class="logout-btn">Logout</button>
                </form>
        </div>
    </header>

    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="Products.php"><button class="sidebar-btn">Manage Products</button></a>
            <a href="Orders.php"><button class="sidebar-btn">Manage Orders</button></a>
            <a href="Inventory.php"><button class="sidebar-btn">Inventory</button></a>
        </aside>

        <!-- Main Content -->
        <div class="container">
            <div class="inventory-actions">
                <form method="POST" action="Inventory.php">
                    <input type="text" id="searchProductInput" name="search" placeholder="Search by product name or ID ..." />
                    <button type="submit" class="action-btn" id="searchProductBtn">Search</button>
                </form>
            </div>

            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody id="inventoryTableBody">
                    <?php
                    // Fetch product data from the database
                    if ($result->num_rows > 0) {
                        // Output each row of data from the products table
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['productID'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['category'] . "</td>
                                    <td>" . $row['quantity'] . "</td>
                                    <td>" . $row['price'] . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No products available</td></tr>";
                    }

                    $conn->close(); // Close the database connection
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="inventory.js"></script>
</body>
</html>

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

// Check if there is a search query
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
    <title>Manage Products</title>
    <link rel="stylesheet" href="products.css">
</head>
<body>
<header>
    <div class="header-title">Manage Products</div>
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
        <div class="product-actions">
            <div>
                <a href="Add_product.php"><button class="action-btn" id="addProductBtn">Add Product</button></a>
                <button class="action-btn" id="deleteSelectedBtn">Delete Selected</button>
            </div>
            <div>
                <form method="POST" action="Products.php">
                    <input type="text" id="searchProductInput" name="search" placeholder="Search by product name or ID ..." />
                    <button type="submit" class="action-btn" id="searchProductBtn">Search</button>
                </form>
            </div>
        </div>

        <!-- Product Table Container -->
        <div class="product-table-container">
            <!-- Product Table -->
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price (Taka)</th>
                        <th>Manufacturing Date</th>
                        <th>Expiration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <?php
                    // Fetch product data from the database
                    if ($result->num_rows > 0) {
                        // Output each row of data from the products table
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td><input type='checkbox' name='selectProduct' value='" . $row['productID'] . "'></td>
                                    <td>" . $row['productID'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['category'] . "</td>
                                    <td>" . $row['quantity'] . "</td>
                                    <td>" . $row['price'] . "</td>
                                    <td>" . $row['manufactureDate'] . "</td>
                                    <td>" . $row['expirationDate'] . "</td>
                                    <td>
                                        <a href='edit_product.php?productID=" . $row['productID'] . "'>
                                            <button class='action-btn-edit'>Edit</button>
                                        </a>
                                        <form method='POST' action='../Model/Delete_product.php' style='display:inline;'>
                                            <input type='hidden' name='productID' value='" . $row['productID'] . "'>
                                            <button type='submit' class='action-btn-delete'>Delete</button>
                                        </form>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No products available</td></tr>";
                    }

                    $conn->close(); // Close the database connection
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../Controller/products.js"></script>

</body>
</html>

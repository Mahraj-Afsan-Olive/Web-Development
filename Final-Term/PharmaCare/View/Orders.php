
<?php

// Start session
session_start();
// Check if the session is active and the user is logged in as admin
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login/loginFormAdmin.php");
    exit();
}

// Set a cookie to remember the user 
setcookie("user_email", $_SESSION['email'], time() + (86400 * 30), "/"); // 30-day cookie
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
    <title>Manage Orders</title>
    <link rel="stylesheet" href="orders.css">
</head>
<body>
    <header>
        <div class="header-title">Manage Orders</div>
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
            <div class="order-actions">
                <div>
                    <button class="action-btn" id="markShippedBtn">Mark as Shipped</button>
                </div>
                <div>
                    <input type="text" id="searchOrderInput" placeholder="Search orders..." />
                    <button class="action-btn" id="searchOrderBtn">Search</button>
                </div>
            </div>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Shipping Date</th> <!-- Added Shipping Date column -->
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>ORD12345</td>
                        <td>John Doe</td>
                        <td>Paracetamol</td>
                        <td>5</td>
                        <td>$25</td>
                        <td>2025-01-01</td>
                        <td>2025-01-05</td> <!-- Example shipping date -->
                        <td>Pending</td>
                        <td>
                            <button class="complete-btn">Complete</button>
                            <button class="cancel-btn">Cancel</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Order History Button -->
            <div class="order-history-btn-container">
                <button class="order-history-btn" id="orderHistoryBtn">View Order History</button>
            </div>

            <!-- Modal for Order History -->
            <div id="orderHistoryModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" id="closeModalBtn">&times;</span>
                    <h2>Order History</h2>
                    <div class="order-history-content">
                        <!-- The order history data will be injected here by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="orders.js"></script>
</body>
</html>

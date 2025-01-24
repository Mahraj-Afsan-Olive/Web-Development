
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
    <title>Manage Content - Admin Panel</title>
    <link rel="stylesheet" href="content_styles.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">Admin Panel</div>
            <div class="user-info">
                <span>Welcome, Admin</span>
                <form method="POST" style="display:inline;">
                    <button type="submit" name="logout" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container">

        <div class="sidebar">
            <ul>
                <li><a href="Admin_Dashboard.php"><button class="dashboard-btn">Dashboard</button></a></li>
                <li><a href="Manage_Users.php"><button class="manage-users-btn">Manage Users</button></a></li>
                <li><a href="Approve_Users.php"><button class="approve-users-btn">Approve Users</button></a></li>
                <li><a href="Manage_Content.php"><button class="manage-content-btn">Manage Content</button></a></li>
                <li><a href="Profile.php"><button class="profile-btn">Profile</button></a></li>
            </ul>
        </div>

        <div class="main-content">
            <h2>Manage Content</h2><br>
            <div class="content-options">
                <!-- First row -->
                <div class="row">
                    <a href="Products.php"><button class="content-btn">Manage Products</button></a>
                    <a href="Orders.php"><button class="content-btn">Manage Orders</button></a>
                </div>
                <!-- Second row -->
                <div class="row">
                    <a href="Inventory.php"><button class="content-btn">Inventory</button></a>
                    <a href="../Accounts/record.php"><button class="content-btn">Records</button></a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Company Name. All rights reserved.</p>
    </footer>
</body>
</html>

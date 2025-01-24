<?php
session_start();
include('../Model/db_connect.php'); 

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
    <title>Manage Users - Admin Panel</title>
    <link rel="stylesheet" href="manage_styles.css">
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
            <h2>Manage Users</h2><br>
            <div class="user-actions">
                <a href="Add_User.php"><button class="add-user-btn">Add New User</button></a>
                <form method="POST" action="Manage_Users.php" style="display: flex; align-items: center;">
                    <input type="text" placeholder="Search users..." name="search" id="searchInput">
                    <button type="submit" id="searchBtn">Search</button>
                </form>
            </div>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <?php
                    // Array of table names and their primary key column
                    $tables = [
                        'admin_users' => 'admin_id',
                        'employee_users' => 'employee_id',
                        'researcher_users' => 'researcher_id',
                        'accountant_users' => 'accountant_id'
                    ];

                    foreach ($tables as $table => $primaryKey) {
                        $sql = "SELECT $primaryKey AS id, username, email, role, status FROM $table";
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['username']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['role']}</td>
                                    <td>{$row['status']}</td>
<td>
    <button class='remove-btn' data-action='remove' data-table='{$table}' data-id='{$row['id']}'>Remove</button>
</td>


                                </tr>";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Company Name. All rights reserved.</p>
    </footer>

    <script src="../Controller/manage_users.js"></script>
</body>
</html>

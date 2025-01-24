<?php

include('../Model/db_connect.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = $_POST['role'];
    $status = 'Active'; 

    // Determine the table name based on the role
    $table = '';
    switch ($role) {
        case 'admin':
            $table = 'admin_users';
            break;
        case 'employee':
            $table = 'employee_users';
            break;
        case 'researcher':
            $table = 'researcher_users';
            break;
        case 'accountant':
            $table = 'accountant_users';
            break;
        default:
            echo "<script>alert('Invalid role selected!'); window.location.href='Add_User.php';</script>";
            exit;
    }

    // SQL query to insert data
    $sql = "INSERT INTO $table (username, email, password, role, status) 
            VALUES (?, ?, ?, ?, ?)";

    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters and execute the query
        $stmt->bind_param("sssss", $username, $email, $password, $role, $status);

        if ($stmt->execute()) {
            echo "<script>alert('User created successfully!'); window.location.href='Manage_Users.php';</script>";
        } else {
            echo "<script>alert('Error creating user: " . $stmt->error . "');</script>";
        }

        $stmt->close(); 
    } else {
        echo "<script>alert('Error preparing the statement: " . $conn->error . "');</script>";
    }
}

$conn->close(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="add_user_styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Create New User</h2>
            <form method="POST" action="Add_User.php">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="input-group">
                    <label for="role">Role</label>
                    <select id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>
                        <option value="researcher">Researcher</option>
                        <option value="accountant">Accountant</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Create User</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Company Name. All rights reserved.</p>
    </footer>
</body>
</html>

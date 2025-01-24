<?php
include('db_connect.php'); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = $_POST['role'];
    $status = 'Active'; 

  
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
        default:
            echo "<script>alert('Invalid role selected.'); window.location.href='../View/Add_User.php';</script>";
            exit;
    }

    // SQL query 
    $sql = "INSERT INTO $table (username, email, password, role, status) 
            VALUES ('$username', '$email', '$password', '$role', '$status')";

    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User created successfully!'); window.location.href='../View/Manage_Users.php';</script>";
    } else {
        echo "<script>alert('Error creating user: " . $conn->error . "'); window.location.href='../View/Manage_Users.php';</script>";
    }
}
?>

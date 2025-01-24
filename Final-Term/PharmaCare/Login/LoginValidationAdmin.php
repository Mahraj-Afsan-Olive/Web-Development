<?php
// Start session
session_start();


include('../Model/db_connect.php'); 


$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';


if (empty($email) || empty($password)) {
    echo "<script>alert('Email and password are required.'); window.location.href='loginFormAdmin.php';</script>";
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format.'); window.location.href='loginFormAdmin.php';</script>";
    exit();
}

// Query the database to validate the user
$query = "SELECT * FROM admin_users WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    
    if (password_verify($password, $user['password'])) { 

        $_SESSION['email'] = $user['email']; 
        $_SESSION['role'] = 'admin'; 


        setcookie("user_email", $user['email'], time() + (86400 * 30), "/"); // Expires in 30 days

        // Redirect to the Admin Dashboard
        header("Location: ../View/Admin_Dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='loginFormAdmin.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No account found with the provided email.'); window.location.href='loginFormAdmin.php';</script>";
    exit();
}
?>

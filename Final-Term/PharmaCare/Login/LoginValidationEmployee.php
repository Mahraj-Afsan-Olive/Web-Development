<?php
// Start session
session_start();


include('../Model/db_connect.php'); 

// Retrieve the email and password from the form
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Check if email and password are provided
if (empty($email) || empty($password)) {
    echo "<script>alert('Email and password are required.'); window.location.href='loginFormEmployee.php';</script>";
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format.'); window.location.href='loginFormEmployee.php';</script>";
    exit();
}

// Query the database to validate the user
$query = "SELECT * FROM employee_users WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $user['password'])) { 
       
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = 'admin'; 

        
        header("Location: ../View/Products.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='loginFormEmployee.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No account found with the provided email.'); window.location.href='loginFormEmployee.php';</script>";
    exit();
}
?>

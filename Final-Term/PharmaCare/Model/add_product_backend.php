<?php
include('db_connect.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $productID = $_POST['productID'];
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $manufacturingDate = $_POST['manufacturingDate'];
    $expirationDate = $_POST['expirationDate'];

    //  SQL query
    $sql = "INSERT INTO products (productID, name, category, quantity, price, manufactureDate, expirationDate)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

   
    $stmt = $conn->prepare($sql);

   
    $stmt->bind_param("issdiis", $productID, $productName, $category, $quantity, $price, $manufacturingDate, $expirationDate);

    
    if ($stmt->execute()) {
        // Redirect to the Products page after successful insertion
        header("Location: ../View/Products.php");
        exit();
    } else {
        
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();

    $conn->close();
}
?>

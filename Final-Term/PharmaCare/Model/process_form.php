<?php
include('db_connect.php');  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $productID = $_POST['productID'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $manufactureDate = $_POST['manufactureDate'];
    $expirationDate = $_POST['expirationDate'];

    //  SQL statement
    $sql = "INSERT INTO products (productID, name, category, quantity, price, manufactureDate, expirationDate) 
            VALUES ('$productID', '$name', '$category', $quantity, $price, '$manufactureDate', '$expirationDate')";

    if ($conn->query($sql) === TRUE) {
        
        echo "New product added successfully!";
        header('Location: ../View/Products.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

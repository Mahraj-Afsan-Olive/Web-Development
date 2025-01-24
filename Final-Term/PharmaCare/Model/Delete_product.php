<?php
include('db_connect.php'); 

if (isset($_POST['productID'])) {
    $productID = $_POST['productID'];

  
    $deleteSQL = "DELETE FROM products WHERE productID = '$productID'";

    if ($conn->query($deleteSQL) === TRUE) {
        echo "Product deleted successfully.";
        header("Location: ../View/Products.php"); 
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

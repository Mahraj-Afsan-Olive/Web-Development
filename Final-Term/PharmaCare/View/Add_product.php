<?php
include('../Model/db_connect.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="add_product.css">
    <script src="../Controller/add_product.js"></script> 
</head>
<body>

    <h1>Add Product</h1>
    <form id="addProductForm" action="../Model/add_product_backend.php" method="POST" onsubmit="validateForm(event)">
        <div>
            <label for="productID">Product ID:</label>
            <input type="text" id="productID" name="productID" readonly>
        </div>
        <div>
            <label for="productName">Name:</label>
            <input type="text" id="productName" name="productName" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">Select Category</option>
                <option value="Pain Relievers">Pain Relievers</option>
                <option value="Antibiotics">Antibiotics</option>
                <option value="Vitamins and Supplements">Vitamins and Supplements</option>
                <option value="Antiseptics">Antiseptics</option>
                <option value="Skin Care">Skin Care</option>
                <option value="Respiratory">Respiratory</option>
                <option value="Antidiabetic">Antidiabetic</option>
                <option value="Cardiovascular">Cardiovascular</option>
                <option value="Digestive Health">Digestive Health</option>
                <option value="Cough and Cold">Cough and Cold</option>
            </select>
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required min="0">
        </div>
        <div>
            <label for="price">Price (Taka):</label>
            <input type="number" id="price" name="price" required step="0.01" min="0">
        </div>
        <div>
            <label for="manufacturingDate">Manufacturing Date:</label>
            <input type="date" id="manufacturingDate" name="manufacturingDate" required>
        </div>
        <div>
            <label for="expirationDate">Expiration Date:</label>
            <input type="date" id="expirationDate" name="expirationDate" required>
        </div>
        <div>
            <button type="submit">Add Product</button>
        </div>
    </form>

</body>
</html>

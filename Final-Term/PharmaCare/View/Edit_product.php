<?php
include('../Model/db_connect.php'); 


if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];

    
    $sql = "SELECT * FROM products WHERE productID = '$productID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
}


$categorySQL = "SELECT DISTINCT category FROM products";
$categoryResult = $conn->query($categorySQL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form values
    $name = $_POST['name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $manufactureDate = $_POST['manufactureDate'];
    $expirationDate = $_POST['expirationDate'];

    // Update product in the database
    $updateSQL = "UPDATE products SET 
                  name = '$name', 
                  category = '$category', 
                  quantity = '$quantity', 
                  price = '$price', 
                  manufactureDate = '$manufactureDate', 
                  expirationDate = '$expirationDate' 
                  WHERE productID = '$productID'";

    if ($conn->query($updateSQL) === TRUE) {
        echo "Product updated successfully.";
        header("Location: ../View/Products.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
<header>
    <div class="header-title">Edit Product</div>
</header>

<div class="main-container">
    <div class="container">
        <form action="edit_product.php?productID=<?php echo $productID; ?>" method="POST" id="editProductForm">
            <label for="name">Product Name:</label>
            <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>

            <label for="category">Category:</label>
            <select name="category" required>
                <?php
                if ($categoryResult->num_rows > 0) {
                    while ($row = $categoryResult->fetch_assoc()) {
                        $selected = ($row['category'] == $product['category']) ? "selected" : "";
                        echo "<option value='" . $row['category'] . "' $selected>" . $row['category'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No categories available</option>";
                }
                ?>
            </select><br>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required><br>

            <label for="price">Price (Taka):</label>
            <input type="number" name="price" value="<?php echo $product['price']; ?>" step="0.01" min="0" required><br>

            <label for="manufactureDate">Manufacturing Date:</label>
            <input type="date" name="manufactureDate" value="<?php echo $product['manufactureDate']; ?>" required><br>

            <label for="expirationDate">Expiration Date:</label>
            <input type="date" name="expirationDate" value="<?php echo $product['expirationDate']; ?>" required><br>

            <button type="submit">Update Product</button>
        </form>
    </div>
</div>
<script src="edit_product.js"></script>
</body>
</html>

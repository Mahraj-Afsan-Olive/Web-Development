// Function to auto-generate Product ID
function generateProductID() {
    // For example, generating a random 6-digit number as product ID
    const productID = Math.floor(Math.random() * 900000 + 100000);
    document.getElementById('productID').value = productID;
}

// Function to validate the form
function validateForm(event) {
    
    event.preventDefault();

    // Get form field values
    const productName = document.getElementById('productName').value;
    const category = document.getElementById('category').value;
    const quantity = document.getElementById('quantity').value;
    const price = document.getElementById('price').value;
    const manufacturingDate = document.getElementById('manufacturingDate').value;
    const expirationDate = document.getElementById('expirationDate').value;

    // Regular expression to allow only letters, numbers, and spaces for product name
    const nameRegex = /^[a-zA-Z0-9\s]+$/;

    // Validation for Product Name
    if (!nameRegex.test(productName)) {
        alert("Product Name can only contain letters, numbers, and spaces.");
        return false;
    }

    // Validation for Quantity and Price (cannot be negative)
    if (quantity < 0) {
        alert("Quantity cannot be negative.");
        return false;
    }
    if (price < 0) {
        alert("Price cannot be negative.");
        return false;
    }

    // Validation for Manufacturing Date and Expiration Date (cannot be the same)
    if (manufacturingDate === expirationDate) {
        alert("Manufacturing Date and Expiration Date cannot be the same.");
        return false;
    }

    // If all validations pass, submit the form
    document.getElementById('addProductForm').submit();
}

// Run the generateProductID function when the page loads
window.onload = generateProductID;

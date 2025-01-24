<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Shop</title>
    <link rel="stylesheet" href="customer.css">
</head>
<body>
    <header>
        <h1>Customer Shop</h1>
        <div class="auth-buttons">
            <button id="signIn">Sign Up</button>
            <button id="logIn">Log In</button>
            <button id="cartBtn" style="display: none;">Cart (<span id="cartCount">0</span>)</button>
        </div>
    </header>

    <main>
        <h1>Products</h1>
        <div id="products"></div>
    </main>

    <div id="cartModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Your Cart</h2>
            <ul id="cartItems"></ul>
            <button id="checkout">Checkout</button>
        </div>
    </div>

    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Order Summary</h2>
            <p id="orderDetails"></p>
            <label for="paymentOption">Select Payment Option:</label>
            <select id="paymentOption">
                <option value="Bank">Bank</option>
                <option value="Visa">Visa Card</option>
            </select>
            <div id="bankDetails" style="display: none;">
                <label for="name">Name:</label>
                <input type="text" id="name" placeholder="Enter Name" required>
                <label for="accountNumber">Account Number:</label>
                <input type="text" id="accountNumber" placeholder="Enter Account Number" required>
            </div>
            <div id="visaDetails" style="display: none;">
                <label for="cardNumber">Card Number:</label>
                <input type="text" id="cardNumber" placeholder="Enter Card Number" required>
                <label for="cardPassword">Card Password:</label>
                <input type="password" id="cardPassword" placeholder="Enter Card Password" required>
            </div>
            <button id="makePayment">Make Payment</button>
        </div>
    </div>

    <div id="orderConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Successfully Order Placed</h2>
            <p>Further any Query Contact with Us via Hotline: 9090</p>
        </div>
    </div>

    <script src="customer.js"></script>
</body>
</html>

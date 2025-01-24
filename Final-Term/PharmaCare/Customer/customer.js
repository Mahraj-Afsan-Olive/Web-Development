document.addEventListener("DOMContentLoaded", () => {
    const products = [
        { id: 1, name: "Paracetamol", price: 10 },
        { id: 2, name: "Insulin", price: 50 },
        { id: 3, name: "Esomeprazole", price: 20 },
        { id: 4, name: "Ibuprofen", price: 15 },
        { id: 5, name: "Aspirin", price: 8 },
        { id: 6, name: "Amoxicillin", price: 30 },
        { id: 7, name: "Lisinopril", price: 12 },
        { id: 8, name: "Losartan", price: 40 },
        { id: 9, name: "Paroxetine", price: 25 },
        { id: 10, name: "Omeprazole", price: 18 },
        { id: 11, name: "Captopril", price: 22 },
        { id: 12, name: "Metformin", price: 35 },
        { id: 13, name: "Hydrochlorothiazide", price: 10 },
        { id: 14, name: "Prednisone", price: 40 },
        { id: 15, name: "Cetirizine", price: 5 }
    ];

    let cart = [];
    

    const productContainer = document.getElementById("products");
    const cartBtn = document.getElementById("cartBtn");
    const cartCount = document.getElementById("cartCount");
    const cartItems = document.getElementById("cartItems");
    const cartModal = document.getElementById("cartModal");
    const paymentModal = document.getElementById("paymentModal");
    const orderConfirmationModal = document.getElementById("orderConfirmationModal");
    const closeBtn = document.querySelectorAll(".close");

    const checkoutButton = document.getElementById("checkout");
    const makePaymentButton = document.getElementById("makePayment");
    const paymentOption = document.getElementById("paymentOption");
    const bankDetails = document.getElementById("bankDetails");
    const visaDetails = document.getElementById("visaDetails");
    const orderDetails = document.getElementById("orderDetails");
    const nameInput = document.getElementById("name");
    const accountNumberInput = document.getElementById("accountNumber");
    const cardNumberInput = document.getElementById("cardNumber");
    const cardPasswordInput = document.getElementById("cardPassword");

    function renderProducts() {
        productContainer.innerHTML = "";
        products.forEach((product) => {
            const productEl = document.createElement("div");
            productEl.classList.add("product");
            productEl.innerHTML = `
                <h3>${product.name}</h3>
                <p>ID: ${product.id}</p>
                <p>Price: $${product.price}</p>
                <button onclick="addToCart(${product.id})">Add to Cart</button>
            `;
            productContainer.appendChild(productEl);
        });
    }



    function updateCartUI() {
        cartCount.innerText = cart.length;
        cartItems.innerHTML = "";
        cart.forEach((item, index) => {
            const li = document.createElement("li");
            li.innerHTML = `${item.name} - $${item.price} <button onclick="removeFromCart(${index})">Remove</button>`;
            cartItems.appendChild(li);
        });
    }

    window.removeFromCart = (index) => {
        cart.splice(index, 1);
        updateCartUI();
    };

    document.getElementById("signIn").addEventListener("click", () => {
        isAuthenticated = true;
        cartBtn.style.display = "inline";
        alert("Signed in successfully!");
    });

    document.getElementById("logIn").addEventListener("click", () => {
        isAuthenticated = true;
        cartBtn.style.display = "inline";
        alert("Logged in successfully!");
    });

    cartBtn.addEventListener("click", () => {
        cartModal.style.display = "block";
    });

    closeBtn.forEach(btn => {
        btn.addEventListener("click", () => {
            cartModal.style.display = "none";
            paymentModal.style.display = "none";
            orderConfirmationModal.style.display = "none";
        });
    });

    checkoutButton.addEventListener("click", () => {
        if (cart.length === 0) {
            alert("Your cart is empty!");
            return;
        }
        let totalAmount = cart.reduce((total, product) => total + product.price, 0);
        let orderDetailsText = `Items in cart: <br>`;
        cart.forEach(item => {
            orderDetailsText += `${item.name} - $${item.price} <br>`;
        });
        orderDetailsText += `Total: $${totalAmount}`;
        orderDetails.innerHTML = orderDetailsText;

        cartModal.style.display = "none";
        paymentModal.style.display = "block";
    });

    paymentOption.addEventListener("change", () => {
        if (paymentOption.value === "Bank") {
            bankDetails.style.display = "block";
            visaDetails.style.display = "none";
        } else {
            bankDetails.style.display = "none";
            visaDetails.style.display = "block";
        }
    });

    makePaymentButton.addEventListener("click", () => {
        const selectedPayment = paymentOption.value;
        if (selectedPayment === "Bank") {
            const name = nameInput.value;
            const accountNumber = accountNumberInput.value;
            alert(`Payment of $${cart.reduce((total, product) => total + product.price, 0)} processed via Bank.\nName: ${name}, Account: ${accountNumber}`);
        } else {
            const cardNumber = cardNumberInput.value;
            const cardPassword = cardPasswordInput.value;
            alert(`Payment of $${cart.reduce((total, product) => total + product.price, 0)} processed via Visa.\nCard Number: ${cardNumber}, Card Password: ${cardPassword}`);
        }

        // Clear cart after payment
        cart = [];
        updateCartUI();
        paymentModal.style.display = "none";
        orderConfirmationModal.style.display = "block";
    });

    renderProducts();
});

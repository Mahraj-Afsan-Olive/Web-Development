// Get buttons and table body
const markShippedBtn = document.getElementById('markShippedBtn');
const orderTableBody = document.querySelector('.order-table tbody');

// Handle "Mark as Shipped" functionality
markShippedBtn.addEventListener('click', () => {
    const rows = orderTableBody.querySelectorAll('tr');
    rows.forEach((row) => {
        const checkbox = row.querySelector('input[type="checkbox"]');
        const statusCell = row.cells[7]; 
        const shippingDateCell = row.cells[8]; 
        if (checkbox && checkbox.checked && statusCell.textContent === 'Pending') {
            statusCell.textContent = 'Shipped';
            const shippingDate = new Date().toLocaleDateString(); 
            shippingDateCell.textContent = shippingDate; 
        }
    });
});

// "Cancel" button functionality for each row
const cancelBtns = document.querySelectorAll('.cancel-btn');
cancelBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        const row = e.target.closest('tr');
        row.querySelector('td:nth-child(9)').textContent = 'Cancelled'; 
    });
});


const searchOrderBtn = document.getElementById('searchOrderBtn');
const searchOrderInput = document.getElementById('searchOrderInput');

searchOrderBtn.addEventListener('click', () => {
    const searchTerm = searchOrderInput.value.toLowerCase();
    const rows = orderTableBody.querySelectorAll('tr');
    
    rows.forEach((row) => {
        const orderIDCell = row.cells[1]; 
        const customerNameCell = row.cells[2]; 
        const productCell = row.cells[3]; 
        const orderID = orderIDCell.textContent.toLowerCase();
        const customerName = customerNameCell.textContent.toLowerCase();
        const product = productCell.textContent.toLowerCase();
        
       
        if (orderID.includes(searchTerm) || customerName.includes(searchTerm) || product.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Get elements for the modal
const orderHistoryBtn = document.getElementById('orderHistoryBtn');
const orderHistoryModal = document.getElementById('orderHistoryModal');
const closeModalBtn = document.getElementById('closeModalBtn');
const orderHistoryContent = document.querySelector('.order-history-content');

// Data for demonstration purposes (Replace with real order history data)
const orderHistoryData = [
    { orderId: 'ORD12345', customerName: 'John Doe', product: 'Paracetamol', quantity: 5, totalPrice: '$25', orderDate: '2025-01-01', shippingDate: '2025-01-05', status: 'Shipped' },
    { orderId: 'ORD12346', customerName: 'Jane Smith', product: 'Aspirin', quantity: 2, totalPrice: '$15', orderDate: '2025-01-02', shippingDate: '2025-01-06', status: 'Shipped' },
    // Add more data as needed
];

// Function to populate the modal with order history data
function populateOrderHistory() {
    let htmlContent = '<table><thead><tr><th>Order ID</th><th>Customer Name</th><th>Product</th><th>Quantity</th><th>Total Price</th><th>Order Date</th><th>Shipping Date</th><th>Status</th></tr></thead><tbody>';

    orderHistoryData.forEach(order => {
        htmlContent += `<tr>
            <td>${order.orderId}</td>
            <td>${order.customerName}</td>
            <td>${order.product}</td>
            <td>${order.quantity}</td>
            <td>${order.totalPrice}</td>
            <td>${order.orderDate}</td>
            <td>${order.shippingDate}</td>
            <td>${order.status}</td>
        </tr>`;
    });

    htmlContent += '</tbody></table>';
    orderHistoryContent.innerHTML = htmlContent;
}

// Show the modal
orderHistoryBtn.addEventListener('click', () => {
    populateOrderHistory(); // Fill the modal with data
    orderHistoryModal.style.display = 'block';
});

// Close the modal when the user clicks the close button
closeModalBtn.addEventListener('click', () => {
    orderHistoryModal.style.display = 'none';
});

// Close the modal if the user clicks outside of it
window.addEventListener('click', (e) => {
    if (e.target === orderHistoryModal) {
        orderHistoryModal.style.display = 'none';
    }
});

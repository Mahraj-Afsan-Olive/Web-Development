document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchProductInput');
    const tableRows = document.querySelectorAll('.inventory-table tbody tr');

    // Function to highlight matched rows
    function highlightMatchedRows() {
        const searchTerm = searchInput.value.toLowerCase();
        
        tableRows.forEach(row => {
            const productID = row.cells[0].textContent.toLowerCase();
            const productName = row.cells[1].textContent.toLowerCase();
            
            if (productID.includes(searchTerm) || productName.includes(searchTerm)) {
                row.style.backgroundColor = '#e0f7fa';  
            } else {
                row.style.backgroundColor = '';  
            }
        });
    }

 
    searchInput.addEventListener('input', highlightMatchedRows);
});

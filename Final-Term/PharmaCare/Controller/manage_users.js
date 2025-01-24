document.addEventListener('DOMContentLoaded', function () {
    const userTableBody = document.getElementById('userTableBody');

    userTableBody.addEventListener('click', function (event) {
        const target = event.target;
        if (target.classList.contains('remove-btn')) {
            const userId = target.getAttribute('data-id');
            const userTable = target.getAttribute('data-table');

            if (confirm('Are you sure you want to remove this user?')) {
                fetch('../Model/remove_user.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: userId, table: userTable }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            target.closest('tr').remove(); 
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    });
});

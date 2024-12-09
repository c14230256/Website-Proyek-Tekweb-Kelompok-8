document.addEventListener('DOMContentLoaded', () => {
    loadUsers();

    // Function to load the list of users from the server
    function loadUsers() {
        fetch('fetch_users.php')
            .then(response => response.text())
            .then(data => document.getElementById('userTableBody').innerHTML = data);
    }

    // Event listener to handle clicks on delete buttons
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('delete-user')) {
            const userId = event.target.dataset.id;
            if (confirm('Are you sure you want to delete this user?')) {
                fetch('delete_user.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({ user_id: userId })
                }).then(() => loadUsers());
            }
        }
    });
});

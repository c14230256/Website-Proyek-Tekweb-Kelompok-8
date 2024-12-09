document.addEventListener('DOMContentLoaded', () => {
    loadAdmins();

    // Function to load the list of admins from the server
    function loadAdmins() {
        fetch('fetch_admins.php')
            .then(response => response.text())
            .then(data => document.getElementById('adminTableBody').innerHTML = data);
    }

    // Event listener to handle clicks on delete buttons
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('delete-admin')) {
            const adminId = event.target.dataset.id;
            if (confirm('Are you sure you want to delete this admin?')) {
                fetch('delete_admin.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({ admin_id: adminId })
                }).then(() => loadAdmins());
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    loadAdmins();

    // Function to load the list of admins from the server
    function loadAdmins() {
        fetch('fetch_admins.php')
            .then(response => response.text())
            .then(data =>{ document.getElementById('adminTableBody').innerHTML = data
                disableTheOnlyAdmin();
            });
            
    }

    function disableTheOnlyAdmin() {
        const rows = document.querySelectorAll('#adminTableBody tr');
        rows.forEach(row => {
            const delete_admin = row.querySelector('.delete-admin');
            if (rows.length === 1) {
                delete_admin.disabled = true;
                delete_admin.title = "Cannot delete the last remaining admin.";
            } else {
                delete_admin.disabled = false;
                delete_admin.title = "";
            }
        });
    }

    // Event listener to handle clicks on delete buttons
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('delete-admin')) {
            const adminId = event.target.dataset.id;
            if (document.querySelectorAll('#adminTableBody tr').length === 1) {
                alert('You cannot delete the last remaining admin.');
                return;
            }

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

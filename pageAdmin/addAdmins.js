document.addEventListener('DOMContentLoaded', () => {
    loadAdmins();

    // Function untuk fetch user yang non admin
    function loadAdmins() {
        fetch('fetch_make_admins.php')
            .then(response => response.text())
            .then(data => document.getElementById('make_adminTableBody').innerHTML = data);
    }

    // Event listener untuk clicks pada button
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('make-admin')) {
            const userId = event.target.dataset.id;
            if (confirm('Are you sure you want to make this user an admin?')) {
                fetch('make_admin.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({ user_id: userId })
                }).then(() => loadAdmins());
            }
        }
    });
});

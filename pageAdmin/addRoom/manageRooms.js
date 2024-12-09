document.addEventListener('DOMContentLoaded', () => {
    loadRooms();

    // Function to load the list of rooms from the server
    function loadRooms() {
        fetch('fetch_rooms.php')
            .then(response => response.text())
            .then(data => document.getElementById('roomTableBody').innerHTML = data);
    }

    // Event listener to handle clicks on delete buttons
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('delete-room')) {
            const roomId = event.target.dataset.id;
            if (confirm('Are you sure you want to delete this room?')) {
                fetch('delete_room.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({ room_id: roomId })
                }).then(() => loadRooms());
            }
        }
    });
});

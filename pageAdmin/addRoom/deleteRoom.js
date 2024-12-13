document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-room');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const roomId = this.getAttribute('data-id');
            
            if (confirm('Are you sure you want to delete this room?')) {
                fetch('deleteRoom.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `room_id=${roomId}`
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        alert('Room deleted successfully.');
                        location.reload();
                    } else {
                        alert('Failed to delete room.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});


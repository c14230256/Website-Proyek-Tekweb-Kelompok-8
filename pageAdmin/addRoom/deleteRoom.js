document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-room');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const roomId = this.getAttribute('data-id');
            console.log('Delete button clicked for room ID:', roomId); // Debug

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
                    console.log('Server response:', data); // Debug
                    if (data.trim() === 'success') {
                        alert('Room deleted successfully.');
                        location.reload();
                    } else {
                        alert('Room deleted');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete room due to an error.');
                });
            }
        });
    });
});



document.addEventListener('DOMContentLoaded', function() {
  let currentRoomIndex = 0;
  let roomsData = [];

  function loadRooms() {
      fetch('fetch_rooms_home.php')
          .then(response => response.json()) // Assuming the PHP returns JSON
          .then(data => {
              console.log('Rooms data:', data); // Debug log
              roomsData = data;
              displayRoom(currentRoomIndex);
          })
          .catch(error => console.error('Error fetching room data:', error));
  }

  function displayRoom(index) {
      if (roomsData.length > 0) {
          const room = roomsData[index];
          const roomDisplay = document.getElementById('roomDisplay');
          roomDisplay.innerHTML = `
              <h2>${room.room_type}</h2>
              <img src="${room.image_url}" alt="${room.room_type}" />
              <p>${room.description}</p>
              <p>Price: $${room.price}</p>
              <p>Status: ${room.room_status ? 'Available' : 'Unavailable'}</p>
          `;
      }
  }

  document.getElementById('nextRoom').addEventListener('click', function() {
      if (currentRoomIndex < roomsData.length - 1) {
          currentRoomIndex++;
      } else {
          currentRoomIndex = 0; // Loop back to the first room
      }
      displayRoom(currentRoomIndex);
  });

  document.getElementById('prevRoom').addEventListener('click', function() {
      if (currentRoomIndex > 0) {
          currentRoomIndex--;
      } else {
          currentRoomIndex = roomsData.length - 1; // Loop to the last room
      }
      displayRoom(currentRoomIndex);
  });

  loadRooms();
});

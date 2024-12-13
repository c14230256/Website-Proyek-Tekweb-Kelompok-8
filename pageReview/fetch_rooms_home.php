<?php
include '../db_config/connection.php'; 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Fetching rooms..."; // Debug message

$sql = "SELECT * FROM room";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='room'>";
        echo "<h2>" . $row["room_type"] . "</h2>";
        echo "<img src='" . $row["image_url"] . "' alt='" . $row["room_type"] . "' />";
        echo "<p>" . $row["description"] . "</p>";
        echo "<p>Price: $" . $row["price"] . "</p>";
        echo "<p>Status: " . ($row["room_status"] ? 'Available' : 'Unavailable') . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No rooms found</p>";
}

$conn->close();
?>


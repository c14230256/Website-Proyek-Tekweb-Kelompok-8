<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyek_tekweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM room";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["room_id"] . "</td>";
        echo "<td>" . $row["room_type"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . ($row["room_status"] ? 'Available' : 'Unavailable') . "</td>";
        echo "<td><button class='btn btn-danger delete-room' data-id='" . $row["room_id"] . "'>Delete</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No rooms found</td></tr>";
}

$conn->close();
?>


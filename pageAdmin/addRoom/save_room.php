<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyek_tekweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$roomType = $_POST['roomType'];
$description = $_POST['description'];
$price = $_POST['price'];
$status = $_POST['status'];
$image_url = $_POST['image_url'];

$sql = "INSERT INTO room (room_type, description, price, room_status, image_url) VALUES ('$roomType', '$description', '$price', '$status', '$image_url')";

if ($conn->query($sql) === TRUE) {
    echo "New room added successfully";
    header("Location: ../manageRoom.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


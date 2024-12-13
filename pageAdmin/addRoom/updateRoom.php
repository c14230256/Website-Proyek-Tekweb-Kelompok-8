<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyek_tekweb";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan data dari formulir
$room_id = $_POST['room_id'];
$roomType = $_POST['roomType'];
$description = $_POST['description'];
$price = $_POST['price'];
$image_url = $_POST['image_url'];
$status = $_POST['status'];

// Membuat query untuk memperbarui data kamar
$sql = "UPDATE room SET room_type = ?, description = ?, price = ?, room_status = ?, image_url = ? WHERE room_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdisi", $roomType, $description, $price, $status, $image_url, $room_id);

if ($stmt->execute()) {
    echo "Room updated successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect kembali ke halaman manageRooms.php setelah memperbarui data
header("Location: manageRoom.php");
exit();
?>

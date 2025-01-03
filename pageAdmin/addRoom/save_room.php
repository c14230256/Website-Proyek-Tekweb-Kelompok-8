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
$roomType = $_POST['roomType'];
$description = $_POST['description'];
$price = $_POST['price'];
$image_url = $_POST['image_url'];
$status = $_POST['status'];

// Membuat query untuk menyimpan data ke tabel room
$sql = "INSERT INTO room (room_type, description, price, room_status, image_url) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdis", $roomType, $description, $price, $status, $image_url);

if ($stmt->execute()) {
    echo "New room added successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect kembali ke halaman manageRooms.php setelah menyimpan data
header("Location: manageRoom.php");
exit();
?>



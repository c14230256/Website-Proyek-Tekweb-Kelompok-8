<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyek_tekweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$input = json_decode(file_get_contents('php://input'), true);
$user_email = $input['email'];
$user_password = $input['password'];

$sql = "SELECT * FROM `user` WHERE `user_email` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($user_password, $user['pass_user'])) {
    session_start();
    $_SESSION['user'] = $user; // Store user info in session

    if ($user['role'] == 1) {
        echo json_encode(['success' => true, 'redirect' => '../pageAdmin/pageAdmin.html']);
    } else {
        echo json_encode(['success' => true, 'redirect' => '../pageReview/pageReview.html']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
}

$stmt->close();
$conn->close();
?>

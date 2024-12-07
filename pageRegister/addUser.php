<?php
include '../db_config/connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($fullname) || empty($email) || empty($password)) {
        die("Please fill in all fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "console.log('Form submission intercepted!')";
        exit;
    }


    $salt = bin2hex(random_bytes(16));

    $hashedPassword = hash('sha256', $password . $salt);

    $stmt = $conn->prepare("INSERT INTO user (name_user, user_email, pass_user, salt) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param("ssss", $fullname, $email, $hashedPassword, $salt);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        if ($conn->errno == 1062) { // Duplicate email error
            echo "Error: This email address is already registered.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
$conn->close();

?>

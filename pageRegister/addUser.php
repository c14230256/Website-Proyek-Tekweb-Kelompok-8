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
        echo "Invalid email format.";
        exit;
    }

    // Generate a random salt
    $salt = bin2hex(random_bytes(16));

    // Combine password and salt, then hash
    $hashedPassword = hash('sha256', $password . $salt);

    // Prepare the SQL query to insert user data
    $stmt = $conn->prepare("INSERT INTO user (name_user, user_email, pass_user, salt) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param("ssss", $fullname, $email, $hashedPassword, $salt);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        if ($conn->errno == 1062) { // jika ada email yang sama (email itu unique)
            echo "Error: This email address is already registered.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
$conn->close();
?>

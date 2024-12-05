<?php
include '/db_config/connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $Userpassword = $_POST['Userpassword'] ?? '';

    if (!empty($name) && !empty($email) && !empty($age)) {
        $stmt = $conn->prepare("INSERT INTO users (name, email, Userpassword) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $email, $age);

        if ($stmt->execute()) {
            echo "User successfully registered!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required!";
    }

    $conn->close();
}
?>

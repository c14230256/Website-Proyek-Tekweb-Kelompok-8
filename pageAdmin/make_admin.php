<?php 
require "../db_config/connection.php";

//update user role menjadi admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $stmt = $conn->prepare("UPDATE user SET role = 1 WHERE id_user = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "User successfully made an admin.";
    } else {
        echo "Error updating user role.";
    }

    $stmt->close();
    $conn->close();

    
}else {
    echo "Invalid request method.";
}

?>
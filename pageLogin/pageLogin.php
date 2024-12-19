<?php
include '..db_config/connection.php'; // Include your database connection file

$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$email = $input['email'];
$password = $input['password'];

$query = $pdo->prepare("SELECT * FROM `user` WHERE `user_email` = :email");
$query->execute(['email' => $email]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['pass_user'])) {
    session_start();
    $_SESSION['user'] = $user; // Store user info in session

    if ($user['role'] == 1) {
        echo json_encode(['success' => true, 'redirect' => '../pageAdmin/pageAdmin.html']);
    } else {
        echo json_encode(['success' => true, 'redirect' => '../pageReview/pagePreview.html']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
}
?>

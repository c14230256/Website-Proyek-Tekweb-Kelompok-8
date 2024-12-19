<?php
session_start();
require '../db_config/connection.php'; // For the database connection

// Check if user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect to login page if user is not logged in
    header("Location: ../pageLogin/viewReservation.php?redirect=../pageBooking/cancelReservation.php");
    exit;
}

$reservation_id = $_GET['id'];
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login

// Check if the reservation belongs to the logged-in user
$sql = "SELECT * FROM reservation WHERE reservation_id = '$reservation_id' AND user_id = '$user_id'";
$reservation_result = mysqli_query($conn, $sql);
$reservation = mysqli_fetch_assoc($reservation_result);

// If the reservation doesn't exist, show an error
if (!$reservation) {
    echo "Reservation not found.";
    exit;
}

// Delete the reservation
$delete_sql = "DELETE FROM reservation WHERE reservation_id = '$reservation_id'";

if (mysqli_query($conn, $delete_sql)) {
    header("Location: ../pageBooking/viewReservation.php");
    exit;
} else {
    echo "Error canceling reservation: " . mysqli_error($conn);
}

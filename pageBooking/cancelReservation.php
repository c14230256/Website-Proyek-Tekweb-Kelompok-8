<?php
session_start();
require '../db_config/connection.php'; // For the database connection

// Check if user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: ../pageLogin/pageLogin.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Assuming you store user_id in session after login

// Get reservation ID from query string or form
$reservation_id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($reservation_id) {
    // Fetch the reservation status
    $sql = "SELECT reservation_status FROM reservation WHERE reservation_id = '$reservation_id' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $reservation = mysqli_fetch_assoc($result);

    if ($reservation) {
        if (in_array($reservation['reservation_status'], ['pending', 'accepted'])) {
            // Allow deletion if status is pending or accepted
            $delete_sql = "DELETE FROM reservation WHERE reservation_id = '$reservation_id' AND user_id = '$user_id'";
            if (mysqli_query($conn, $delete_sql)) {
                $message = "Reservation canceled successfully.";
            } else {
                $message = "Error canceling reservation: " . mysqli_error($conn);
            }
        } else {
            $message = "Reservation cannot be canceled because it is already checked-in or checked-out.";
        }
    } else {
        $message = "Reservation not found or you do not have permission to cancel this reservation.";
    }
} else {
    $message = "Invalid reservation ID.";
}

// Redirect back to the reservations page with message
header("Location: viewReservation.php?message=" . urlencode($message));
exit;
?>

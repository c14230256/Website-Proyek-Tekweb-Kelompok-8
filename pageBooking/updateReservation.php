<?php
session_start();
require '../db_config/connection.php'; // For the database connection

// Check if user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect to login page if user is not logged in
    header("Location: ../pageLogin/pageLogin.php?redirect=../pageBooking/updateReservation.php");
    exit;
}

$reservation_id = $_GET['id'];
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login

// Fetch the reservation details
$sql = "SELECT * FROM reservation WHERE reservation_id = '$reservation_id' AND user_id = '$user_id'";
$reservation_result = mysqli_query($conn, $sql);
$reservation = mysqli_fetch_assoc($reservation_result);

// Check if the reservation exists
if (!$reservation) {
    echo "Reservation not found.";
    exit;
}

// Handle reservation update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    $update_sql = "UPDATE reservation SET check_in = '$check_in', check_out = '$check_out' WHERE reservation_id = '$reservation_id'";
    
    if (mysqli_query($conn, $update_sql)) {
        header("Location: viewReservations.php?message=Reservation updated successfully");
        exit;
    } else {
        echo "Error updating reservation: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">
        <img src="../Image/KrustyLogo.png" class="krusty-logo" />
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link" href="../pageReview/pagePreview.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../pageRoom/pageRoom.html">Room</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pageAccomendations/pageAcco.html">Accommodation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pageBooking/bookingRoom.php">Book Room</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Update Reservation Form -->
<div class="container mt-4">
    <h2>Update Reservation</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="check_in" class="form-label">Check-in</label>
            <input type="date" name="check_in" id="check_in" class="form-control" value="<?= $reservation['check_in']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="check_out" class="form-label">Check-out</label>
            <input type="date" name="check_out" id="check_out" class="form-control" value="<?= $reservation['check_out']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Reservation</button>
    </form>
</div>

</body>
</html>

<?php
session_start();
require '../db_config/connection.php'; // For the database connection

// Check if user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect to login page with the redirect parameter to go back to view reservations after login
    header("Location: ../pageLogin/pageLogin.php?redirect=../pageBooking/viewReservations.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Assuming you store user_id in session after login

// Fetch reservations for the logged-in user
$sql = "SELECT * FROM reservation WHERE user_id = '$user_id' ORDER BY reservation_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Reservations</title>
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

<!-- View Reservations -->
<div class="container mt-4">
    <h2>Your Reservations</h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($reservation = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $reservation['room_id']; ?></td>
                        <td><?= $reservation['check_in']; ?></td>
                        <td><?= $reservation['check_out']; ?></td>
                        <td><?= $reservation['reservation_status']; ?></td>
                        <td>
                            <a href="updateReservation.php?id=<?= $reservation['reservation_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="cancelReservation.php?id=<?= $reservation['reservation_id']; ?>" class="btn btn-danger">Cancel</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No reservations found.</p>
    <?php } ?>
</div>

</body>
</html>

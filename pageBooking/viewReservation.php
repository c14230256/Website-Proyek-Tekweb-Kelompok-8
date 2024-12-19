<?php
session_start();
require '../db_config/connection.php'; // For the database connection

// Check if user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect to login page with the redirect parameter to go back to view reservations after login
    header("Location: ../pageLogin/pageLogin.php?redirect=../pageBooking/viewReservations.php");
    exit;
}

// Debug session data
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

$user_id = $_SESSION['user_id']; // Assuming you store user_id in session after login

// Fetch reservations for the logged-in user
$stmt = $conn->prepare("SELECT * FROM reservation WHERE user_id = ? ORDER BY reservation_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Debug SQL results
echo '<pre>';
print_r(mysqli_fetch_all($result, MYSQLI_ASSOC));
echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="booking.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="header">
    <nav class="navbar navbar-expand-lg">
        <!-- logo-->
        <a class="navbar-brand" href="#">
            <img src="../Image/KrustyLogo.png" class="krusty-logo" />
        </a>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="../pageReview/pagePreview.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="color: black;" href="../pageRoom/pageRoom.html">Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="../pageAccomendations/pageAcco.html">Accommodation</a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center">
                <li style="float: right" class="nav-item">
                    <a class="nav-link" style="color: black;" href="../pageBooking/bookingRoom.php">Book Room</a>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                    Hello, <?= htmlspecialchars($_SESSION['username']); ?>!
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="../pageLogin/logout.php" >Logout</a>
                </li>
            </ul>
        </div>
    </nav>
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

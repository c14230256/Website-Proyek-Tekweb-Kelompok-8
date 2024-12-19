<?php
session_start();
require '../db_config/connection.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: ../pageLogin/pageLogin.php?redirect=../pageBooking/viewReservations.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM reservation WHERE user_id = ? ORDER BY reservation_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

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
                    <a class="nav-link" style="color: black;" href="../pageReview/pagePreview.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="color: black;" href="../pageRoom/pageRoom.html">Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="../pageAccomendations/pageAcco.html">Accommodation</a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="../pageBooking/bookingRoom.php">Book Room</a>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                    Hello, <?= htmlspecialchars($_SESSION['username']); ?>!
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="../pageLogin/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</nav>

<!-- View Reservations -->
<div class="container mt-4">
    <h2>Your Reservations</h2>

    <?php if ($result->num_rows > 0) { ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($reservation = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['room_id']); ?></td>
                        <td><?= htmlspecialchars($reservation['check_in']); ?></td>
                        <td><?= htmlspecialchars($reservation['check_out']); ?></td>
                        <td><?= htmlspecialchars($reservation['reservation_status']); ?></td>
                        <td>
                            <a href="updateReservation.php?id=<?= $reservation['reservation_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="cancelReservation.php?id=<?= $reservation['reservation_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this reservation?');">Cancel</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="alert alert-info">No reservations found.</p>
    <?php } ?>
</div>

</body>
</html>

<?php
// Close the database connection
$stmt->close();
$conn->close();
?>

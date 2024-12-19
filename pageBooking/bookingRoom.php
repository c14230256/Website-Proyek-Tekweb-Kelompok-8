<?php
session_start();
require '../db_config/connection.php'; // For the database connection

// Check if user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || !isset($_SESSION['user_id'])) {
    // Redirect to login page with the redirect parameter to go back to booking room after login
    header("Location: ../pageLogin/pageLogin.php?redirect=../pageBooking/bookingRoom.php");
    exit;
}

// Get the user_id from the session
$user_id = $_SESSION['user_id'];

// Fetch rooms for the selection dropdown
$sql = "SELECT * FROM room"; // Assume a 'room' table exists with room details
$result = mysqli_query($conn, $sql);

// Handle reservation form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Check if the user exists in the database
    $sql = "SELECT * FROM user WHERE id_user = '$user_id'";
    $user_check = mysqli_query($conn, $sql);

    if (mysqli_num_rows($user_check) > 0) {
        // User exists, proceed with the reservation
        $query = "INSERT INTO reservation (user_id, room_id, check_in, check_out, reservation_status, reservation_date)
                  VALUES ('$user_id', '$room_id', '$check_in', '$check_out', 'Pending', NOW())"; // NOW() to insert the current timestamp

        if (mysqli_query($conn, $query)) {
            $message = "Reservation made successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    } else {
        // User does not exist
        $message = "User not found, please log in again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="booking.css" />
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
                <a class="nav-link" href="#">Accommodation</a>
            </li>
        </ul>

        <ul class="navbar-nav align-items-center">
            <li style="float: right" class="nav-item">
                <a class="nav-link" href="../pageBooking/bookingRoom.php">Book Room</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../pageBooking/bookingRoom.php">Book Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../pageLogin/pageLogin.html">Login</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>

<!-- Booking Room Form -->
<div class="container mt-4">
    <h2>Reserve a Room</h2>
    <form method="POST" action="bookingRoom.php">
        <div class="mb-3">
            <label for="room_id" class="form-label">Select Room</label>
            <select name="room_id" id="room_id" class="form-select" required>
                <?php while ($room = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?= $room['room_id']; ?>"><?= $room['room_type']; ?> - $<?= $room['price']; ?>/night</option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="check_in" class="form-label">Check-in Date</label>
            <input type="date" name="check_in" id="check_in" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="check_out" class="form-label">Check-out Date</label>
            <input type="date" name="check_out" id="check_out" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Room</button>
    </form>
    
    <?php if (isset($message)) { ?>
        <div class="alert alert-info mt-3"><?= $message; ?></div>
    <?php } ?>
</div>

</body>
</html>

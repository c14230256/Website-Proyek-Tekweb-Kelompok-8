<?php
session_start();
require '../db_config/connection.php'; // For the database connection

// Check if user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect to login page with the redirect parameter to go back to booking room after login
    header("Location: ../pageLogin/pageLogin.php?redirect=../pageBooking/bookingRoom.php");
    exit;
}

// Handle reservation form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user input
    $userId = $_SESSION['user_id'];
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Fetch the price of the selected room
    $room_query = "SELECT price FROM room WHERE room_id = '$room_id'";
    $room_result = mysqli_query($conn, $room_query);

    if ($room_result && mysqli_num_rows($room_result) > 0) {
        $room = mysqli_fetch_assoc($room_result);
        $room_price = $room['price'];

        // Calculate the total price based on the difference between check-in and check-out dates
        $check_in_date = new DateTime($check_in);
        $check_out_date = new DateTime($check_out);
        $interval = $check_in_date->diff($check_out_date);
        $days = $interval->days;
        $total_price = $days * $room_price;

        // Insert the reservation into the database
        $query = "INSERT INTO reservation (user_id, room_id, check_in, check_out, reservation_status, reservation_date, total_price)
                  VALUES ('$userId', '$room_id', '$check_in', '$check_out', 'Pending', NOW(), '$total_price')";

        if (mysqli_query($conn, $query)) {
            // Success: Redirect to avoid resubmission
            header("Location: bookingRoom.php?message=Reservation+made+successfully&total_price=$total_price");
            exit;
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    } else {
        $message = "Room not found or unavailable.";
    }
}

// Fetch rooms for the selection dropdown
$sql = "SELECT * FROM room"; // Assume a 'room' table exists with room details
$result = mysqli_query($conn, $sql);

// Fetch any existing reservation
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login
$reservation_sql = "SELECT * FROM reservation WHERE user_id = '$user_id' AND reservation_status = 'Pending' ORDER BY reservation_date DESC LIMIT 1";
$reservation_result = mysqli_query($conn, $reservation_sql);
$reservation = mysqli_fetch_assoc($reservation_result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../pageBooking/booking.css" />
</head>
<body>

<nav class="header">
    
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
            <img src="../Image/KrustyLogo.png" style="width: 75px" class="krusty-logo" />
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="../pageReview/pagePreview.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../pageRoom/pageRoom.html">Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pageAccomendations/pageAcco.html">Accommodation</a>
                </li>
                <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) { ?>
                    <!-- If the user is logged in, show "Book Room", "View Reservation" and "Logout" -->
                    <?php
                    // Check if the user has any pending reservation
                    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
                    $reservation_sql = "SELECT * FROM reservation WHERE user_id = '$user_id' AND reservation_status = 'Pending' ORDER BY reservation_date DESC LIMIT 1";
                    $reservation_result = mysqli_query($conn, $reservation_sql);
                    $reservation = mysqli_fetch_assoc($reservation_result);
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../pageBooking/bookingRoom.php">Book Room</a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pageBooking/viewReservation.php">View Reservation</a>
                        </li>
                    <li class="nav-item">
                        <span class="nav-link">
                        Hello, <?= htmlspecialchars($_SESSION['username']); ?>!
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pageLogin/logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <!-- If the user is not logged in, show "Login" -->
                    <li class="nav-item">
                        <a class="nav-link" href="../pageLogin/pageLogin.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</nav>


<!-- Booking Room Form -->
<div class="content">
    <div class="container mt-4">
        <h2>Reserve a Room</h2>
        
        <!-- Display message -->
        <?php if (isset($_GET['message'])) { ?>
            <div class="alert alert-info mt-3"><?= htmlspecialchars($_GET['message']); ?></div>
        <?php } ?>

        <!-- Display Existing Reservation -->
        <?php if ($reservation) { ?>
            <div class="alert alert-warning mt-3">
                You already have a pending reservation!<br>
                Room: <?= $reservation['room_id']; ?><br>
                Check-in: <?= $reservation['check_in']; ?><br>
                Check-out: <?= $reservation['check_out']; ?>
            </div>
        <?php } ?>

        <form method="POST" action="bookingRoom.php">
    <div class="mb-3">
        <label for="room_id" class="form-label">Room</label>
        <select name="room_id" id="room_id" class="form-select" required>
            <option value="" selected disabled>Select a Room</option>
            <?php while ($room = mysqli_fetch_assoc($result)) { ?>
                <option value="<?= $room['room_id']; ?>" data-price="<?= $room['price']; ?>">
                    <?= $room['room_type']; ?> - $<?= $room['price']; ?>/night
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="check_in" class="form-label">Check-in</label>
        <input type="date" name="check_in" id="check_in" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="check_out" class="form-label">Check-out</label>
        <input type="date" name="check_out" id="check_out" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Book Room</button>
</form>

<!-- Total Price Display -->
<div id="totalPriceContainer" class="mt-3" style="display: none;"></div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function calculateTotalPrice() {
            const roomPrice = parseFloat($('#room_id option:selected').data('price')); // Get selected room price
            const checkInDate = new Date($('#check_in').val()); // Get check-in date
            const checkOutDate = new Date($('#check_out').val()); // Get check-out date

            if (!isNaN(roomPrice) && checkInDate && checkOutDate && checkOutDate > checkInDate) {
                const days = (checkOutDate - checkInDate) / (1000 * 60 * 60 * 24); // Calculate the number of days
                const totalPrice = days * roomPrice;

                $('#totalPriceContainer').html(`Total Price: $${totalPrice.toFixed(2)}`).show();
            } else {
                $('#totalPriceContainer').hide();
            }
        }

        // Trigger the calculation when any of the inputs change
        $('#room_id, #check_in, #check_out').on('change', calculateTotalPrice);

        // Initially hide the total price container
        $('#totalPriceContainer').hide();
    });
</script>


</body>
</html>

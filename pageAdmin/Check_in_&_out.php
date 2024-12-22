<?php
session_start();
require '../db_config/connection.php'; // For the database connection

// Check if the user is an admin and logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== '1') {
    header("Location: ../pageLogin/pageLogin.php");
    exit;
}

// Handle check-in and check-out status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservation_id']) && isset($_POST['status'])) {
    $reservation_id = $_POST['reservation_id'];
    $status = $_POST['status'];

    // Fetch reservation and room data
    $sql = "SELECT reservation.*, room.price FROM reservation
            JOIN room ON reservation.room_id = room.room_id
            WHERE reservation.reservation_id = '$reservation_id'";
    $result = mysqli_query($conn, $sql);
    $reservation = mysqli_fetch_assoc($result);

    if ($status == 'checked_in') {
        // Calculate total price
        $check_in = new DateTime($reservation['check_in']);
        $check_out = new DateTime($reservation['check_out']);
        $interval = $check_in->diff($check_out);
        $days = $interval->days;

        $total_price = $days * $reservation['price'];

        // Update reservation status and total price
        $sql = "UPDATE reservation SET reservation_status = '$status', total_price = '$total_price' WHERE reservation_id = '$reservation_id'";
        mysqli_query($conn, $sql);

        // Insert transaction without payment_date
        $insert_sql = "INSERT INTO transaction (reservation_id, cost, transaction_status)
                       VALUES ('$reservation_id', '$total_price', 'unpaid')";
        mysqli_query($conn, $insert_sql);
    } elseif ($status == 'checked_out') {
        // Update reservation status
        $sql = "UPDATE reservation SET reservation_status = '$status' WHERE reservation_id = '$reservation_id'";
        mysqli_query($conn, $sql);

        // Update transaction status and payment date
        $payment_date = $reservation['check_out'];
        $update_sql = "UPDATE transaction SET transaction_status = 'paid', payment_date = '$payment_date' WHERE reservation_id = '$reservation_id'";
        mysqli_query($conn, $update_sql);
    }
}

// Fetch all reservations
$sql = "SELECT reservation.*, user.user_email, room.room_type FROM reservation 
        JOIN user ON reservation.user_id = user.id_user 
        JOIN room ON reservation.room_id = room.room_id 
        WHERE reservation_status IN ('accepted', 'checked_in', 'checked_out')
        ORDER BY reservation_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Check-Ins and Check-Outs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="pageReservationCSS.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
            <img src="../Image/KrustyLogo.png" class="krusty-logo" />
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" href="pageAdmin.php">page Admin</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h1 class="text-center">Manage Check-Ins and Check-Outs</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>User Email</th>
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
                        <td><?= $reservation['reservation_id']; ?></td>
                        <td><?= $reservation['user_email']; ?></td>
                        <td><?= $reservation['room_type']; ?></td>
                        <td><?= $reservation['check_in']; ?></td>
                        <td><?= $reservation['check_out']; ?></td>
                        <td><?= $reservation['reservation_status']; ?></td>
                        <td>
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="reservation_id" value="<?= $reservation['reservation_id']; ?>">
                                <?php if ($reservation['reservation_status'] == 'accepted') { ?>
                                    <button type="submit" name="status" value="checked_in" class="btn btn-primary">Check-In</button>
                                <?php } elseif ($reservation['reservation_status'] == 'checked_in') { ?>
                                    <button type="submit" name="status" value="checked_out" class="btn btn-primary">Check-Out</button>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>


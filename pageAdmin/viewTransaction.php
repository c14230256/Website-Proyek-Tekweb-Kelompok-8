<?php
session_start();
require '../db_config/connection.php'; // For the database connection

// Check if the user is an admin and logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== '1') {
    header("Location: ../pageLogin/pageLogin.php");
    exit;
}

// Fetch all transactions
$sql = "SELECT transaction.*, reservation.check_in, reservation.check_out, reservation.total_price, reservation.user_id, reservation.reservation_id
        FROM transaction 
        JOIN reservation ON transaction.reservation_id = reservation.reservation_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Transactions</title>
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
        <h1 class="text-center">View Transactions</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Reservation ID</th>
                    <th>Cost</th>
                    <th>Transaction Status</th>
                    <th>Payment Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($transaction = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $transaction['transaction_id']; ?></td>
                        <td><?= $transaction['reservation_id']; ?></td>
                        <td><?= $transaction['cost']; ?></td>
                        <td><?= $transaction['transaction_status']; ?></td>
                        <td><?= $transaction['payment_date']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

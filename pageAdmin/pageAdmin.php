<?php 
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || $_SESSION['role'] != 1) {
    header("Location: logout.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="pageAdminCss.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <!-- logo-->
        <a class="navbar-brand" href="#">
            <img src="../Image/KrustyLogo.png" class="krusty-logo" />
        </a>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <span class="nav-link active">Welcome Back, Admin <?= htmlspecialchars($_SESSION['user_id']);?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pageLogin/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container main-content mt-5">
        <h1 class="text-center">Admin Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <a href="addRoom/manageRoom.php" class="btn btn-primary w-100 mb-3">Manage Rooms</a>
            </div>
            <div class="col-md-4">
                <a href="manageUsers.html" class="btn btn-primary w-100 mb-3">Manage Users</a>
            </div>
            <div class="col-md-4">
                <a href="manageAdmins.html" class="btn btn-primary w-100 mb-3">Manage Admins</a>
            </div>
            <div class="col-md-4">
                <a href="Check_in_&_out.php" class="btn btn-primary w-100 mb-3">Manage Check in & Check Out</a>
            </div>
            <div class="col-md-4">
                <a href="manage_reservation.php" class="btn btn-primary w-100 mb-3">Manage Reservation</a>
            </div>
        </div>
    </div>
</body>
</html>


<?php
session_start();
include('../db_config/connection.php'); // For the database connection

// Fetch rooms for the selection dropdown
$sql = "SELECT * FROM room"; // Assume a 'room' table exists with room details
$result = mysqli_query($conn, $sql);

// Handle reservation form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Insert the reservation into the database
    $query = "INSERT INTO reservation (room_id, check_in, check_out, reservation_status)
              VALUES ('$room_id', '$check_in', '$check_out', 'Pending')";
    
    if (mysqli_query($conn, $query)) {
        $message = "Reservation made successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
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
    
    <!-- Include other styles or scripts here -->
</head>
<body>

<?php include('header.php'); ?>
<div class="main-content">
            <div class="content">
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
        <div class="alert alert-info mt-3">
            <?= $message; ?>
        </div>
    <?php } ?>
    </div>
            <div class="footer">
                <p>
                    &copy; Krusty Tower. All rights reserved to Mr.Krabs and Nickelodeon.
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>


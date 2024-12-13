<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../pageAdminCSS.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
            <img src="../../Image/KrustyLogo.png" class="krusty-logo" />
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <span class="nav-link active">Edit Room</span>
                </li>
            </ul>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item" style="float: right;">
                        <a class="nav-link" href="manageRooms.php">Back to Manage Rooms</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-content mt-5">
        <h1 class="text-center">Edit Room</h1>
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "proyek_tekweb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $room_id = $_GET['room_id'];
                $sql = "SELECT * FROM room WHERE room_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $room_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                $stmt->close();
                $conn->close();
                ?>
                <form action="updateRoom.php" method="POST">
                    <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">
                    <div class="mb-3">
                        <label for="roomType" class="form-label">Room Type</label>
                        <input type="text" class="form-control" id="roomType" name="roomType" value="<?php echo $row['room_type']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required><?php echo $row['description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $row['image_url']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1" <?php if ($row['room_status'] == 1) echo 'selected'; ?>>Available</option>
                            <option value="0" <?php if ($row['room_status'] == 0) echo 'selected'; ?>>Unavailable</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Room</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

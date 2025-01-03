<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
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
                    <span class="nav-link active">Manage Rooms</span>
                </li>
            </ul>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item" style="float: right;">
                        <a class="nav-link" href="../pageAdmin.php">Admin Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-content mt-5">
        <h1 class="text-center">Manage Rooms</h1>
        <div class="row mt-4">
            <div class="col-md-12">
                <a href="add_room.html" class="btn btn-success mb-3">Add New Room</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Room ID</th>
                            <th>Room Type</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="roomTableBody">
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "proyek_tekweb";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM room";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["room_id"] . "</td>";
                                echo "<td>" . $row["room_type"] . "</td>";
                                echo "<td>" . $row["description"] . "</td>";
                                echo "<td>" . $row["price"] . "</td>";
                                echo "<td>" . ($row["room_status"] ? 'Available' : 'Unavailable') . "</td>";
                                echo "<td>
                                        <a href='editRoom.php?room_id=" . $row["room_id"] . "' class='btn btn-warning'>Edit</a>
                                        <button class='btn btn-danger delete-room' data-id='" . $row["room_id"] . "'>Delete</button>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No rooms found</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="deleteRoom.js"></script>
</body>
</html>

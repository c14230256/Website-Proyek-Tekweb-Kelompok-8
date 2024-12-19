<?php
require '../db_config/connection.php';

$sql = "SELECT id_user, name_user AS name, user_email AS email, role FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_user"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td><button class='btn btn-danger delete-user' data-id='" . htmlspecialchars($row["id_user"]) . "' data-name='" . htmlspecialchars($row["name"]) . "'>Delete</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No users found</td></tr>";
}

$conn->close();
?>


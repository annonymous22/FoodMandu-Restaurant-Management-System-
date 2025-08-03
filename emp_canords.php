<?php
session_start();
include 'db.php';

// Ensure employee is logged in
if (!isset($_SESSION['employee'])) {
    header("Location: emp_login.php");
    exit();
}

// Fetch all reservations that are not yet canceled
$result = $conn->query("SELECT * FROM reservations WHERE cancellation_count = 0");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations</title>
    <link rel="stylesheet" href="emp_css.css">
</head>
<body>

    <h2>📌 Cancelled Reservations</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Guest Name</th>
            <th>Table Number</th>
            <th>Number of Guests</th>
            <th>Reservation Date</th>
            <th>Reservation Time</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['guest_name'] ?></td>
            <td><?= $row['table_number'] ?></td>
            <td><?= $row['num_guests'] ?></td>
            <td><?= $row['reservation_date'] ?></td>
            <td><?= $row['reservation_time'] ?></td>
            <td>
                
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="Employee.php" class="btn btn-primary btn-back">🔙 Back to Dashboard</a>
</body>
</html>

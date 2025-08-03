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

    <!-- Back to Dashboard Button -->
    

    <h2>📌 Active Reservations</h2>
    <table class="table">
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
                <form method="POST" action="cancel_reservation.php">
                    <input type="hidden" name="reservation_id" value="<?= $row['id'] ?>">
                    <button type="submit" class="cancel-btn">Cancel</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <div class="btn-container">
        <a href="Employee.php" class="btn-back">🔙 Back to Dashboard</a>
    </div>
</body>
</html>

<?php
session_start();
include 'db.php';

// Ensure employee is logged in
if (!isset($_SESSION['employee'])) {
    header("Location: emp_login.php");
    exit();
}

// Fetch feedback from the database
$result = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="emp_css.css">
</head>
<body>

    <h2>📢 Customer Feedback</h2>

    <table class="feedback-table">
        <tr>
            <th class="feedback-th">ID</th>
            <th class="feedback-th">Customer Name</th>
            <th class="feedback-th">Feedback</th>
            <th class="feedback-th">Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td class="feedback-td"><?= $row['id'] ?></td>
            <td class="feedback-td"><?= $row['customer_name'] ?></td>
            <td class="feedback-td"><?= $row['message'] ?></td>
            <td class="feedback-td"><?= $row['created_at'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <!-- Back to Dashboard Button -->
    <div class="btn-container">
        <a href="Employee.php" class="btn-back">⬅ Back to Dashboard</a>
    </div>

</body>
</html>
 
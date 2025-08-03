<?php
session_start();
include 'db.php';

// Ensure employee is logged in
if (!isset($_SESSION['employee'])) {
    header("Location: emp_login.php");
    exit();
}

// Fetch all orders that are not yet canceled
$result = $conn->query("SELECT * FROM orders WHERE id NOT IN (SELECT order_id FROM canceled_orders)");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="emp_css.css">
</head>
<body>

    <h2>📌 Active Orders</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Food Item</th>
            <th>Delivery Place</th>
            <th>Delivery Time</th>
            <th>Order Time</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['food_item'] ?></td>
            <td><?= $row['delivery_place'] ?></td>
            <td><?= $row['delivery_time'] ?></td>
            <td><?= $row['order_time'] ?></td>
            <td>
                <form method="POST" action="cancel_order.php">
                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                    <button type="submit" class="cancel-btn">Cancel</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>

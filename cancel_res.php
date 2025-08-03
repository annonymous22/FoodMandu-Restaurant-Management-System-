<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "FoodMandu";

// Connect to database
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$guest_name = $_POST['guest_name'];
$table_number = $_POST['table_number'];

// Check if the reservation exists
$sql = "SELECT * FROM reservations WHERE guest_name='$guest_name' AND table_number='$table_number'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

  
    $check_cancel_sql = "SELECT * FROM cancel_reservations WHERE guest_name='$guest_name' AND table_number='$table_number'";
    $cancel_result = $conn->query($check_cancel_sql);

    if ($cancel_result->num_rows > 0) {
        // Update existing cancellation count
        $cancel_row = $cancel_result->fetch_assoc();
        $cancellation_count = $cancel_row['cancellation_count'] + 1;

        $update_cancel_sql = "UPDATE cancel_reservations SET 
                              cancellation_count = $cancellation_count,
                              cancelled_at = NOW()
                              WHERE guest_name='$guest_name' AND table_number='$table_number'";
        $conn->query($update_cancel_sql);
    } else {
        // Insert a new cancellation record
        $cancellation_count = 1;
        $insert_cancel_sql = "INSERT INTO cancel_reservations (guest_name, table_number, num_guests, reservation_date, reservation_time, cancelled_at, cancellation_count) 
                              VALUES ('{$row['guest_name']}', '{$row['table_number']}', '{$row['num_guests']}', '{$row['reservation_date']}', '{$row['reservation_time']}', NOW(), '$cancellation_count')";
        $conn->query($insert_cancel_sql);
    }

    // Delete from reservations table
    $delete_sql = "DELETE FROM reservations WHERE guest_name='$guest_name' AND table_number='$table_number'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<div style='text-align: center; font-family: Arial, sans-serif; padding: 20px;'>";
        echo "<p style='color: red; font-size: 18px; font-weight: bold;'>Reservation successfully cancelled.</p>";
        echo "<p style='font-size: 16px;'>You now have <strong>$cancellation_count</strong> cancellations.</p>";

        if ($cancellation_count >= 3) {
            echo "<p style='color: red; font-weight: bold;'>Warning: After three cancellations, you will not be allowed to make further reservations.</p>";
        }

        echo "</div>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red; text-align: center;'>No matching reservation found.</p>";
}

$conn->close();
?>

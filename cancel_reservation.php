<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservation_id = $_POST['reservation_id'];

    // Update cancellation count
    $stmt = $conn->prepare("UPDATE reservations SET cancellation_count = cancellation_count + 1 WHERE id = ?");
    $stmt->bind_param("i", $reservation_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Reservation #$reservation_id has been canceled.";
    } else {
        $_SESSION['error'] = "Failed to cancel reservation.";
    }

    header("Location: emp_res.php");
    exit();
}
?>

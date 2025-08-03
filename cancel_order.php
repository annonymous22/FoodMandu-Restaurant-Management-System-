<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];

    // Insert into canceled_orders table
    $stmt = $conn->prepare("INSERT INTO canceled_orders (order_id, cancelled_at) VALUES (?, NOW())");
    $stmt->bind_param("i", $order_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Order #$order_id has been canceled.";
    } else {
        $_SESSION['error'] = "Failed to cancel order.";
    }
    
    header("Location: emp_ords.php");
    exit();
}
?>

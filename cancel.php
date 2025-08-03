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

// Get POST data
$food_item = $_POST['food_item'];
$delivery_place = $_POST['delivery_place'];
$delivery_time = $_POST['delivery_time'];

// Insert cancellation into `cancel` table
$sql = "INSERT INTO `cancel` (food_item, delivery_place, delivery_time) VALUES ('$food_item', '$delivery_place', '$delivery_time')";

// Remove from `order` table
$delete_sql = "DELETE FROM `order` WHERE food_item='$food_item' AND delivery_place='$delivery_place' AND delivery_time='$delivery_time'";

if ($conn->query($sql) === TRUE && $conn->query($delete_sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Order cancelled successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>

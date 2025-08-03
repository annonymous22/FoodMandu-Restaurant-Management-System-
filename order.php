<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "FoodMandu";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed."]));
}

$food_item = $_POST["food_item"];
$delivery_place = $_POST["delivery_place"];
$delivery_time = $_POST["delivery_time"];

$sql = "INSERT INTO orders (food_item, delivery_place, delivery_time) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $food_item, $delivery_place, $delivery_time);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to place order."]);
}

$stmt->close();
$conn->close();
?>

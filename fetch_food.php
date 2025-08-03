<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "FoodMandu";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cuisine = isset($_GET["cuisine"]) ? $_GET["cuisine"] : '';

$sql = "SELECT food_name FROM food_menu WHERE cuisine = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cuisine);
$stmt->execute();
$result = $stmt->get_result();

$food_items = [];
while ($row = $result->fetch_assoc()) {
    $food_items[] = $row;
}

echo json_encode($food_items);

$stmt->close();
$conn->close();
?>

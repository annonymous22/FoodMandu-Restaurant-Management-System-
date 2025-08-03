<?php
$host = "localhost";
$user = "root";  // Change if needed
$pass = "";      // Set your MySQL password if applicable
$dbname = "FoodMandu";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

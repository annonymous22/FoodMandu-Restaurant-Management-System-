<?php

$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "FoodMandu"; 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email is set
if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
    echo "<script>alert('Email field is required!'); window.location.href='trial.html';</script>";
    exit();
}

$email = trim($_POST['email']); // Trim spaces

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format!'); window.location.href='Navigation.html';</script>";
    exit();
}

// Check if email already exists
$sql_check = "SELECT * FROM subscribers WHERE email = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('This email is already subscribed!'); window.location.href='Navigation.html';</script>";
} else {
    // Insert new subscriber
    $sql_insert = "INSERT INTO subscribers (email) VALUES (?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "<script>alert('Thank you for subscribing!'); window.location.href='trial.html';</script>";
    } else {
        echo "<script>alert('Subscription failed. Please try again.'); window.location.href='trial.html';</script>";
    }
}

$stmt->close();
$conn->close();

?>

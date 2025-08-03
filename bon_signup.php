<?php

$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$dbname = "FoodMandu";

// Establish connection
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["pwd"])) {
        header("Location: signup.html?error=" . urlencode("Form fields are missing."));
        exit();
    }

    // Retrieve and sanitize form input
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $pwd = trim($_POST["pwd"]);  // No hashing here

  
    if (empty($username) || empty($email) || empty($pwd)) {
        header("Location: bon_signup.html?error=" . urlencode("All fields are required!"));
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: bon_signup.html?error=" . urlencode("Invalid email format!"));
        exit();
    }

    
    $sql = "INSERT INTO customer (username, email, pwd) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        header("Location: signup.html?error=" . urlencode("Database error: " . $conn->error));
        exit();
    }

    $stmt->bind_param("sss", $username, $email, $pwd);

    if ($stmt->execute()) {
        header("Location: login.html?success=" . urlencode("Account created successfully!"));
        exit();
    } else {
        header("Location: bon_signup.html?error=" . urlencode("Error: " . $stmt->error));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?> 
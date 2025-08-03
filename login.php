<?php
session_start();

$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$dbname = "FoodMandu";

// Establish connection
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["pwd"]);

    if (empty($username) || empty($password)) {
        header("Location: login.html?error=" . urlencode("Username and password are required!"));
        exit();
    }

    // Retrieve user data (No hashing)
    $sql = "SELECT id, username, pwd FROM customer WHERE username = ? AND pwd = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_username, $db_password);
        $stmt->fetch();

        $_SESSION["id"] = $id;
        $_SESSION["username"] = $db_username;
        header("Location: customer.html");
        exit();
    } else {
        header("Location: login.html?error=" . urlencode("Invalid username or password!"));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>

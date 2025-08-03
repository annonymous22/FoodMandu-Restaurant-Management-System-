<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from the database
    $stmt = $conn->prepare("SELECT * FROM employees WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and password matches 
    if ($user && $password == $user['password']) {  
        $_SESSION['employee'] = $user['username'];
        header("Location: Employee.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: emp_login.php");
        exit();
    }
}
?>

<?php
session_start();

// Check if the employee is logged in
if (!isset($_SESSION['employee'])) {
    header("Location: emp_login.php"); // Redirect to login page if not logged in
    exit();
}

// Logout function
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: emp_login.php"); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estyle.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="dashboard-container">
        <h1>🍽️ Employee Dashboard</h1>
        <p>Manage orders, reservations, and customer feedback efficiently.</p>

        <div class="dashboard-links">
            <a href="emp_res.php" class="dashboard-card">
                <i class="fas fa-calendar-check"></i>
                <h3>Reservations</h3>
                <p>Check the latest table reservations.</p>
            </a>

            <a href="emp_ords.php" class="dashboard-card">
                <i class="fas fa-utensils"></i>
                <h3>Orders</h3>
                <p>View all placed food orders.</p>
            </a>

            <a href="emp_canords.php" class="dashboard-card">
                <i class="fas fa-times-circle"></i>
                <h3>Cancelled Reservations</h3>
                <p>Track the cancelled resercvations.</p>
            </a>

            <a href="emp_feed.php" class="dashboard-card">
                <i class="fas fa-comment-dots"></i>
                <h3>Feedback</h3>
                <p>See customer feedback and reviews.</p>
            </a>   
            <a href="emp_review.php" class="dashboard-card">
                <i class="fas fa-comment-dots"></i>
                <h3>Employee Feedback</h3>
                <p>Submit feedback and reviews.</p>
            </a>   
        </div>

        <!-- Sign Out Button -->
        <form method="POST" style="margin-top: 20px; text-align: center;" action="trial.html">
            <button type="submit" name="logout" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </button>
        </form>
    </div>

</body>
</html>

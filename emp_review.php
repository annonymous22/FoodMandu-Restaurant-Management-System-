<?php
session_start();
include 'db.php';

// Ensure employee is logged in
if (!isset($_SESSION['employee'])) {
    header("Location: emp_login.php");
    exit();
}

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_name = $_SESSION['employee']; // Assuming employee name is stored in session
    $review = trim($_POST['review']);

    if (!empty($review)) {
        $stmt = $conn->prepare("INSERT INTO employee_reviews (employee_name, review) VALUES (?, ?)");
        $stmt->bind_param("ss", $employee_name, $review);

        if ($stmt->execute()) {
            $_SESSION['thank_you'] = "Thank you for your feedback, $employee_name! 😊";
            header("Location: emp_review.php"); // Redirect to prevent resubmission
            exit();
        } else {
            $_SESSION['error'] = "Failed to submit review.";
        }
    } else {
        $_SESSION['error'] = "Review message cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Review</title>
    <link rel="stylesheet" href="emp_review.css">
</head>
<body>

    <h2>📝 Submit Your Review</h2>

    <!-- Display Thank You Message -->
    <?php if (isset($_SESSION['thank_you'])) { ?>
        <p class="thank-you-message"><?= $_SESSION['thank_you']; unset($_SESSION['thank_you']); ?></p>
    <?php } ?>

    <!-- Display Error Messages -->
    <?php if (isset($_SESSION['error'])) { ?>
        <p class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php } ?>

    <!-- Review Submission Form -->
    <form method="POST" action="emp_review.php">
        <label for="review">Your Review:</label>
        <textarea id="review" name="review" required></textarea>
        <button type="submit" class="submit-btn">Submit Review</button>
    </form>

</body>
</html>

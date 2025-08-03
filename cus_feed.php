<?php
session_start();
include 'db.php'; // Ensure you have the correct database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = trim($_POST['customer_name']);
    $message = trim($_POST['message']);

    if (!empty($customer_name) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO feedback (customer_name, message, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $customer_name, $message);

        if ($stmt->execute()) {
            $_SESSION['thank_you'] = "Thank you for your feedback, $customer_name! 😊";
        } else {
            $_SESSION['error'] = "Failed to submit feedback.";
        }
    } else {
        $_SESSION['error'] = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="cus_feed.css"> <!-- Separate CSS file -->
</head>
<body>

    <h2>📝 Customer Feedback</h2>

    <?php if (isset($_SESSION['thank_you'])) { ?>
        <p class="thank-you-message"><?= $_SESSION['thank_you']; ?></p>
        <script>
            setTimeout(function() {
                window.location.href = "trial.html"; 
            }, 1000);
        </script>
        <?php unset($_SESSION['thank_you']); ?>
    <?php } ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <p class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php } ?>

    <form method="POST" action="cus_feed.php">
        <label for="customer_name">Your Name:</label>
        <input type="text" id="customer_name" name="customer_name" required>

        <label for="message">Your Feedback:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit" class="submit-btn">Submit Feedback</button>
    </form>

</body>
</html>

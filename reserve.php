<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bonappetit";

// Connect to database
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$guest_name = $_POST['guest_name'];
$table_number = $_POST['table_number'];
$num_guests = $_POST['num_guests'];
$reservation_date = $_POST['reservation_date'];
$reservation_time = $_POST['reservation_time'];

// Check cancellation count from cancel_reservations table
$check_sql = "SELECT cancellation_count FROM cancel_reservations WHERE guest_name='$guest_name'";
$result = $conn->query($check_sql);
$cancellation_count = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cancellation_count = $row['cancellation_count'];
}

// Block reservation if the user has 3 or more cancellations
if ($cancellation_count >= 3) {
    echo "<div class='error-message'>Sorry, due to multiple cancellations, your reservation request is denied.</div>";
} else {
    // Insert reservation
    $sql = "INSERT INTO reservations (guest_name, table_number, num_guests, reservation_date, reservation_time, cancellation_count) 
            VALUES ('$guest_name', '$table_number', '$num_guests', '$reservation_date', '$reservation_time', '$cancellation_count')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <div class='receipt-container'>
            <h2>Reservation Receipt</h2>
            <p><strong>Name:</strong> $guest_name</p>
            <p><strong>Table Number:</strong> $table_number</p>
            <p><strong>Number of Guests:</strong> $num_guests</p>
            <p><strong>Date:</strong> $reservation_date</p>
            <p><strong>Time:</strong> $reservation_time</p>
            <p class='success-message'>Your reservation has been confirmed!</p>
        </div>";
    } else {
        echo "<div class='error-message'>Error: " . $conn->error . "</div>";
    }
}

$conn->close();
?>

<style>
/* Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

/* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f9;
    text-align: center;
    margin: 0;
    padding: 20px;
}

/* Receipt Container */
.receipt-container {
    background: white;
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    text-align: left;
}

/* Headings */
h2 {
    color: #2c3e50;
    font-size: 22px;
    font-weight: 600;
    border-bottom: 2px solid #ff6600;
    padding-bottom: 10px;
    text-align: center;
}

/* Paragraphs */
p {
    font-size: 16px;
    color: #34495e;
    margin: 8px 0;
}

/* Success Message */
.success-message {
    font-size: 18px;
    color: #27ae60;
    font-weight: 600;
    text-align: center;
}

/* Error Message */
.error-message {
    background: #e74c3c;
    color: white;
    font-size: 18px;
    padding: 12px;
    max-width: 400px;
    margin: 20px auto;
    border-radius: 8px;
    font-weight: 600;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
}
</style>

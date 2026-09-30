<?php

require_once "db.php";


// Only allow form submission
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: reservation.html");
    exit();

}


// Create reservations table automatically
$createTable = "CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    guests INT NOT NULL,
    reservation_type VARCHAR(50) NOT NULL,
    special_request TEXT
)";

if (!$conn->query($createTable)) {

    die("Unable to create reservations table: " . $conn->error);

}


// Get form information
$name = trim($_POST["name"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$email = trim($_POST["email"] ?? "");
$date = trim($_POST["date"] ?? "");
$time = trim($_POST["time"] ?? "");
$guests = trim($_POST["guests"] ?? "");
$type = trim($_POST["reservation_type"] ?? "");
$message = trim($_POST["message"] ?? "");


// Check required fields
if (
    $name == "" ||
    $phone == "" ||
    $email == "" ||
    $date == "" ||
    $time == "" ||
    $guests == "" ||
    $type == ""
) {

    die("Please fill in all required fields.");

}


// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    die("Please enter a valid email address.");

}


// Validate phone number
if (!preg_match("/^[0-9]{10}$/", $phone)) {

    die("Please enter a valid 10-digit phone number.");

}


// Validate guests
if (!is_numeric($guests) || $guests < 1 || $guests > 50) {

    die("Number of guests must be between 1 and 50.");

}


// Convert guests to integer
$guests = (int)$guests;


// Insert reservation
$sql = "INSERT INTO reservations
(
    name,
    phone,
    email,
    reservation_date,
    reservation_time,
    guests,
    reservation_type,
    special_request
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);


if (!$stmt) {

    die("Error preparing reservation: " . $conn->error);

}


// Bind values
$stmt->bind_param(
    "sssssiss",
    $name,
    $phone,
    $email,
    $date,
    $time,
    $guests,
    $type,
    $message
);


// Save reservation
if (!$stmt->execute()) {

    die("Unable to save reservation: " . $stmt->error);

}


// Close connection
$stmt->close();
$conn->close();

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Reservation Confirmed - Restro</title>

    <link rel="stylesheet"
          href="css/style.css">

</head>


<body>


<header>

    <nav>

        <h1 class="logo">
            𝙍𝙀𝙎𝙏𝙍𝙊
        </h1>

        <ul>

            <li>
                <a href="index.html">Home</a>
            </li>

            <li>
                <a href="menu.html">Menu</a>
            </li>

            <li>
                <a href="reservation.html">Reservation</a>
            </li>

            <li>
                <a href="gallery.html">Gallery</a>
            </li>

            <li>
                <a href="reviews.html">Reviews</a>
            </li>

            <li>
                <a href="contact.html">Contact</a>
            </li>

        </ul>

    </nav>

</header>


<section class="success-page">

    <div class="success-box">

        <h2>
            Reservation Confirmed! 🎉
        </h2>

        <p>
            Thank you,
            <strong>
                <?php echo htmlspecialchars($name); ?>
            </strong>!
        </p>

        <p>
            Your reservation has been successfully
            confirmed and your details have been saved.
        </p>

        <div class="reservation-details">

            <p>
                <strong>Number of Guests:</strong>
                <?php echo htmlspecialchars($guests); ?>
            </p>

            <p>
                <strong>Date:</strong>
                <?php echo htmlspecialchars($date); ?>
            </p>

            <p>
                <strong>Time:</strong>
                <?php echo htmlspecialchars($time); ?>
            </p>

            <p>
                <strong>Reservation Type:</strong>
                <?php echo htmlspecialchars($type); ?>
            </p>

        </div>

        <p>
            We look forward to welcoming you at Restro!
        </p>

        <div class="success-buttons">

            <a href="index.html" class="food-btn">
                Back to Home
            </a>

            <a href="menu.html" class="food-btn">
                View Menu
            </a>

        </div>

    </div>

</section>


</body>

</html>
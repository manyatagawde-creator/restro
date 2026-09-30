<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $feedback = trim($_POST["feedback"] ?? "");
    $rating = trim($_POST["rating"] ?? "");
    $source = trim($_POST["source"] ?? "Reviews Page");

    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $feedback = htmlspecialchars($feedback);
    $rating = htmlspecialchars($rating);
    $source = htmlspecialchars($source);

    $data = "==============================\n";
    $data .= "RESTRO FEEDBACK\n";
    $data .= "==============================\n";
    $data .= "Date: " . date("d-m-Y H:i:s") . "\n";
    $data .= "Name: " . $name . "\n";
    $data .= "Email: " . $email . "\n";
    $data .= "Rating: " . $rating . "\n";
    $data .= "Feedback: " . $feedback . "\n";
    $data .= "Submitted From: " . $source . "\n";
    $data .= "==============================\n\n";

    $file = "data/feedback.txt";

    file_put_contents($file, $data, FILE_APPEND);

} else {

    header("Location: contact.html");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Feedback Submitted - Restro</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header>

    <nav>

        <h1 class="logo">RESTRO</h1>

        <ul>

            <li><a href="index.html">Home</a></li>
            <li><a href="menu.html">Menu</a></li>
            <li><a href="reservation.html">Reservation</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="reviews.html">Reviews</a></li>
            <li><a href="contact.html">Contact</a></li>

        </ul>

    </nav>

</header>


<section class="success-page">

    <div class="success-box">

        <h2>Thank You!</h2>

        <p>
            Thank you, <?php echo $name; ?>,
            for sharing your feedback.
        </p>

        <p>
            Your response has been saved successfully.
        </p>

        <a href="index.html" class="food-btn">
            Back to Home
        </a>

    </div>

</section>



</body>
</html>
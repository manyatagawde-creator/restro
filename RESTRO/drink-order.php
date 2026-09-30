<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST["name"] ?? "");
    $drink = htmlspecialchars($_POST["drink"] ?? "");
    $quantity = htmlspecialchars($_POST["quantity"] ?? "1");

    $sweetness = htmlspecialchars($_POST["sweetness"] ?? "");
    $ice = htmlspecialchars($_POST["ice"] ?? "");
    $flavour = htmlspecialchars($_POST["flavour"] ?? "");
    $strength = htmlspecialchars($_POST["strength"] ?? "");
    $topping = htmlspecialchars($_POST["topping"] ?? "");
    $thickness = htmlspecialchars($_POST["thickness"] ?? "");
    $mint = htmlspecialchars($_POST["mint"] ?? "");
    $lime = htmlspecialchars($_POST["lime"] ?? "");

    $order = "----------------------------------------\n";
    $order .= "RESTRO CUSTOM DRINK ORDER\n";
    $order .= "----------------------------------------\n";
    $order .= "Customer Name: " . $name . "\n";
    $order .= "Drink: " . $drink . "\n";
    $order .= "Quantity: " . $quantity . "\n";

    if ($sweetness != "") {
        $order .= "Sweetness: " . $sweetness . "\n";
    }

    if ($ice != "") {
        $order .= "Ice: " . $ice . "\n";
    }

    if ($flavour != "") {
        $order .= "Flavour: " . $flavour . "\n";
    }

    if ($strength != "") {
        $order .= "Coffee Strength: " . $strength . "\n";
    }

    if ($topping != "") {
        $order .= "Topping: " . $topping . "\n";
    }

    if ($thickness != "") {
        $order .= "Thickness: " . $thickness . "\n";
    }

    if ($mint != "") {
        $order .= "Mint: " . $mint . "\n";
    }

    if ($lime != "") {
        $order .= "Lime: " . $lime . "\n";
    }

    $order .= "Date: " . date("d-m-Y H:i:s") . "\n";
    $order .= "----------------------------------------\n\n";

    $folder = "data";

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    file_put_contents(
        $folder . "/drink-orders.txt",
        $order,
        FILE_APPEND
    );

    ?>

```
<!DOCTYPE html>

<html>

<head>

    <title>Order Confirmed - Restro</title>

    <link rel="stylesheet"
          href="css/style.css">

</head>

<body>

    <section class="page">

        <div class="content-box">

            <h2>Thank You, <?php echo $name; ?>!</h2>

            <p>
                Your customized
                <strong><?php echo $drink; ?></strong>
                order has been received.
            </p>

            <p>
                We will prepare your drink according
                to your selected preferences.
            </p>

            <a href="menu.html" class="btn">
                Back to Menu
            </a>

        </div>

    </section>

</body>

</html>
```

<?php

}

?>

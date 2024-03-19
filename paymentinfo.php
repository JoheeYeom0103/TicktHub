<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer's Payment Page</title>
    <!-- include css with <link rel="stylesheet" href="filepath.css"> -->
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/leftnav.css">
    <link rel="stylesheet" href="css/paymentinfo.css">
    <!-- include css with <script src="filepath.js">  -->
    <script src="script/paymentinfo.js"></script>

    <?php

    session_start();

    // Accessing session variables
    if(isset($_SESSION['userId'])) {
        $userID = $_SESSION['userId'];
    }

    // Connection information
    $host = "localhost";
    $database = "tickethub";
    $user = "joy";
    $db_password = "joy5767";

    // Create connection
    $connection = mysqli_connect($host, $user, $db_password, $database);

    // Error message
    $error = mysqli_connect_error();

    // If connection is not successful (If any error message exists)
    if ($error != null) {
        $error_message = "Connection failed: " . mysqli_connect_error();
        exit("<p>$error_message</p>");
    }

    // Fetch user details from the database
    $sql = "";
    $pstmt = mysqli_prepare($connection, $sql);

    if ($pstmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($pstmt, "s", $userId);

        // Execute the prepared statement
        mysqli_stmt_execute($pstmt);

        // Bind result variables
        mysqli_stmt_bind_result($pstmt,);

        // Fetch values
        mysqli_stmt_fetch($pstmt);
    }


    ?>
</head>
<body>

<header>
    <h1>TicketHub</h1>
    <ul>
        <li><a href="signup.html">Login/Sign Up!</a></li>
        <li><a href="shoppingcart.html">View Cart</a></li>
    </ul>
</header>

<div id="container">
    <!-- Left side navigator -->
    <nav id="left-nav">
        <ul>
            <li><a href="buyer_personalinfo.html">Personal Info</a></li>
            <li><a href="#">Payment Info</a></li>
            <li><a href="mytickts.html">My Tickets</a></li>
        </ul>
    </nav>

    <!-- Main content -->
    <div id="main-content">
        <div id="payment-details">
            <h2 class="payment-heading">Payment Information</h2>
            <div class="payment-method-container bank-transfer-method-container">
                <h2>Bank Transfer</h2>
                <div class="checkbox-container">
                    <input type="checkbox" checked> <!-- Added checked attribute -->
                    <label>Set As Default Method</label>
                </div>
                <div class="payment-info">
                    <p>Bank Name: XYZ Bank</p>
                    <p>Account Holder Name: John Doe</p>
                    <p>Account Number: 123456789</p>
                </div>
                 <!-- Add a New Method Button -->
                <button class="add-method">Add a New Method</button>
            </div>

            <div class="payment-method-container credit-card-method-container">
                <h2>Credit Card</h2>
                <div class="checkbox-container">
                    <input type="checkbox">
                    <label>Set As Default Method</label>
                </div>
                <div class="payment-info">
                    <p>Card Number: XXXX XXXX XXXX 1234</p>
                    <p>Expiration Date: 12/25</p>
                    <p>Card Holder Name: John Doe</p>
                    <p>Security Code (CVC): 123</p>
                </div>
                <!-- Add a New Method Button -->
                <button class="add-method">Add a New Method</button>
            </div>

            <div class="payment-method-container paypal-method-container">
                <h2>PayPal</h2>
                <div class="checkbox-container">
                    <input type="checkbox">
                    <label>Set As Default Method</label>
                </div>
                <div class="payment-info">
                    <img src="images/paypal.png" alt="PayPal Logo" id="paypal-logo">
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>

</body>
</html>

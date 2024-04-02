<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="css/headerFooter.css">
    <style>
        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes at least full viewport height */
        }

        /* Main container styles */
        #container {
            flex: 1; /* Allow main content to take remaining space */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Order confirmation message styles */
        #order-confirmation-message {
            margin-top: 2em;
            text-align: center;
        }
        footer {
            background-color: #333333;
            color: white;
            text-align: center;
            padding: 2em 0;
            width: 100%;
            margin-top: auto; /* Keep footer at the bottom */
        }
</style>
</head>
<body>

<header>
    <h1>TicketHub</h1>
    <ul>
       <!-- must have been logged in -->
       <li><a href="personalinfo.php">User</a></li>
       <li><a href="shoppingcart.php">View Cart</a></li>
    </ul>
</header>

<div id="container">
    <!-- Order confirmation message -->
    <div id="order-confirmation-message">
        <h2>Thank you for your order!</h2>
        <p>Your order has been successfully placed.</p>
    </div>
</div>
<?php include "dbConnect.php";
    // TODO update insertOrder method with correct variable parameters.
    // insertOrder($connection, );
    mysqli_close($connection); ?>
<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>

</body>
</html>

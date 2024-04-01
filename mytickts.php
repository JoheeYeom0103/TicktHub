<!DOCTYPE html>
<html lang="en">
<head>

    <?php 
        // session logic
        session_start(); 
        if (isset($_SESSION["username"])){
            $username = $_SESSION["username"];
        }else{
            $username = "john_doe";
        }

        // Include the file with the function
        include("php/buyerViewTicketsAction.php");

        // Call the function to get the tickets
        $tickets = getTickets($username);
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/leftnav.css">
    <link rel="stylesheet" href="css/myTicketsStyling.css">
    <!-- Stylesheets -->
</head>
<body>

<header>
    <h1>TicketHub</h1>
    <ul>
        <!-- The user must have been logged in -->
        <li><a href="buyer_personalinfo.php">@<?php echo $username ?></a></li>
        <li><a href="shoppingcart.php">View Cart</a></li>
    </ul>
</header>

<div id="container">
    <!-- Left side navigator -->
    <nav id="left-nav">
        <ul>
            <li><a href="buyerPersonalInfo.php">Personal Info</a></li>
            <li><a href="paymentinfo.php">Payment Info</a></li>
            <li><a href="#">My Tickets</a></li>
        </ul>
    </nav>

    <!-- Main content -->
    <div id="main-content">
        <div id="profile-details">
            <h2 class="profile-heading">My Tickets</h2>
           <!-- Display tickets from the database -->
            <?php while ($row = mysqli_fetch_assoc($tickets)): ?>
                <div class="ticket-box">
                    <div class="ticket-info">
                        <label for="ticketName1">Ticket Name:</label>
                        <span id="ticketName1"><?php echo $row['TicketName']; ?></span>
                    </div>
                    <div class="ticket-info">
                        <label for="location1">Location:</label>
                        <span id="location1"><?php echo $row['Location']; ?></span>
                    </div>
                    <div class="ticket-info">
                        <label for="datetime1">Date & Time:</label>
                        <span id="datetime1"><?php echo $row['DateTime']; ?></span>
                    </div>
                    <div class="ticket-info">
                        <label for="quantity1">Quantity:</label>
                        <span id="quantity1"><?php echo $row['TicketQuantity']; ?></span>
                    </div>
                    <div class="ticket-info">
                        <label for="cost1">Cost:</label>
                        <span id="cost1"><?php echo $row['OrderCost']; ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>

</body>
</html>

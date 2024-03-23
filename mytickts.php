<!DOCTYPE html>
<html lang="en">
<head>
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
        <li><a href="buyer_personalinfo.php">User</a></li>
        <li><a href="shoppingcart.php">View Cart</a></li>
    </ul>
</header>

<div id="container">
    <!-- Left side navigator -->
    <nav id="left-nav">
        <ul>
            <li><a href="buyer_personalinfo.php">Personal Info</a></li>
            <li><a href="paymentinfo.php">Payment Info</a></li>
            <li><a href="#">My Tickets</a></li>
        </ul>
    </nav>

    <!-- Main content -->
    <div id="main-content">
        <div id="profile-details">
            <h2 class="profile-heading">My Tickets</h2>

            <!-- Ticket Boxes -->
            <div class="ticket-box">
                <div class="ticket-info">
                    <label for="ticketName1">Ticket Name:</label>
                    <span id="ticketName1">Concert Ticket</span>
                </div>
                <div class="ticket-info">
                    <label for="location1">Location:</label>
                    <span id="location1">Main Arena</span>
                </div>
                <div class="ticket-info">
                    <label for="datetime1">Date & Time:</label>
                    <span id="datetime1">2024-02-21 19:00</span>
                </div>
                <div class="ticket-info">
                    <label for="quantity1">Quantity:</label>
                    <span id="quantity1">2</span>
                </div>
                <div class="ticket-info">
                    <label for="cost1">Cost:</label>
                    <span id="cost1">$100.00</span>
                </div>
            </div>

            <div class="ticket-box">
                <div class="ticket-info">
                    <label for="ticketName2">Ticket Name:</label>
                    <span id="ticketName2">Movie Ticket</span>
                </div>
                <div class="ticket-info">
                    <label for="location2">Location:</label>
                    <span id="location2">Cinema Hall 2</span>
                </div>
                <div class="ticket-info">
                    <label for="datetime2">Date & Time:</label>
                    <span id="datetime2">2024-02-22 14:30</span>
                </div>
                <div class="ticket-info">
                    <label for="quantity2">Quantity:</label>
                    <span id="quantity2">1</span>
                </div>
                <div class="ticket-info">
                    <label for="cost2">Cost:</label>
                    <span id="cost2">$12.50</span>
                </div>
            </div>

            <div class="ticket-box">
                <div class="ticket-info">
                    <label for="ticketName3">Ticket Name:</label>
                    <span id="ticketName3">Sporting Event Ticket</span>
                </div>
                <div class="ticket-info">
                    <label for="location3">Location:</label>
                    <span id="location3">Stadium</span>
                </div>
                <div class="ticket-info">
                    <label for="datetime3">Date & Time:</label>
                    <span id="datetime3">2024-02-23 15:00</span>
                </div>
                <div class="ticket-info">
                    <label for="quantity3">Quantity:</label>
                    <span id="quantity3">4</span>
                </div>
                <div class="ticket-info">
                    <label for="cost3">Cost:</label>
                    <span id="cost3">$200.00</span>
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

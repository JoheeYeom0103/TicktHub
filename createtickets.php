<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Events</title>
    <!-- stylesheets --> 
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/leftnav.css">    
    <link rel="stylesheet" href="css/createTicketsStyling.css">
    <!-- stylesheets -->
    <!-- JavaScript -->
    <script src="script/createtickets.js"></script>
</head>
<body>

<header>
    <h1>TicketHub</h1>
    <ul>
        <!-- <li><a href="cart.html">View Cart</a></li> -->
        <li><a href="seller_personalinfo.php">User</a></li>
    </ul>
</header>

<div id="container">
    <!-- Left side navigator -->
    <nav id="left-nav">
        <ul>
            <li><a href="seller_personalinfo.php">Personal Info</a></li>
            <li><a href="payoutinfo.php">Payout Info</a></li>
            <li><a href="#">Create Events</a></li>
            <li><a href="salesManageEvents.php">Sales & Manage Events</a></li>
        </ul>
    </nav>

    <!-- Main content -->
    <div id="main-content">
        <div id="profile-details">
            <h3 class="profile-heading">Create Events</h3>

            <!-- Event Information Form -->
            <form id="event-form">
                <div class="event-info">
                    <label for="eventName">Event Name:</label>
                    <input type="text" id="eventName" name="eventName" placeholder="Enter event name" required>
                </div>

                <div class="event-info">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" placeholder="Enter location" required>
                </div>

                <div class="event-info">
                    <label for="dateTime">Date & Time:</label>
                    <input type="datetime-local" id="dateTime" name="dateTime" required>
                </div>

                <div class="event-info">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required>
                </div>

                <div class="event-info">
                    <label for="cost">Cost:</label>
                    <input type="text" id="cost" name="cost" placeholder="Enter cost" required>
                </div>

                <div class="event-info">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" placeholder="Enter description" required></textarea>
                </div>

                <div id="buttons">
                    <button type="button" class="buttons">Cancel</button>
                    <button type="submit" class="buttons" id="post-request-button">Post Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>

</body>
</html>

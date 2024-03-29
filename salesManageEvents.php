<!DOCTYPE html>
<html lang="en">
<head>

    <?php 
        
        // session logic
        session_start(); 
        if (isset($_SESSION["username"])){
            $username = $_SESSION["username"];
        }else{
            $username = "jane_smith";
        }

        include("php/salesManageEventsAction.php");

    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Information</title>
    
    <!-- stylesheets -->
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/leftnav.css">
    <link rel="stylesheet" href="css/salesManageEvents.css">
    <!-- stylesheets -->

    <!-- Scripts -->
    <script src="script/editDeleteEventScript.js"></script>

</head>
<body>
<header>
    <h1>TicketHub</h1>
    <ul>
        <li><a href="seller_personalinfo.php">@<?php echo $username ?></a></li>
        <!-- <li><a href="shoppingcart.html">View Cart</a></li> -->
    </ul>
</header>

<div id="container">
    <!-- Left side navigator -->
    <nav id="left-nav">
        <ul>
            <li><a href="seller_personalinfo.php">Personal Info</a></li>
            <li><a href="payoutinfo.php">Payout Info</a></li>
            <li><a href="createtickets.php">Create Events</a></li>
            <li><a href="salesManageEvents.php">Sales & Manage Events</a></li>
        </ul>
    </nav>

    <!-- Main content -->
    <div id="main-content">
        <div id="profile-details">
            <h3 class="profile-heading">Sales & Manage Events</h3>
            <h3>Sales Synopsis</h3>
            <table class="sellerSalesTable">
                <tr>
                    <th>Month-Year</th>
                    <th>Average Sales</th>
                </tr>
                <?php
                    displaySellerSales($username);
                ?>
            </table>

            <div class="event-list">
                <h3>Current Events</h3>
                <?php
                    // Check if the delete query parameter is present
                    if (isset($_GET['delete']) && $_GET['delete'] == 'success') {
                        echo "<p>Event Deleted Successfully!</p>";
                    }
                ?>

                <table>
                    <tr>
                        <th>Event Name</th>
                        <th>Location</th>
                        <th>Date & Time</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Ticket Status</th>
                        <th colspan=2>Actions</th>
                    </tr>
                    <tr>
                        <?php
                            displayEvents($username);
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>

</body>
</html>

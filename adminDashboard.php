<!DOCTYPE html>
<html>
<head>

    <?php 
    
        // session logic
        session_start(); 
        if (isset($_SESSION["username"])){
            $username = $_SESSION["username"];
        }else{
            $username = "null";
        }
    ?>
    <meta charset="UTF-8">
    <title>Administrator Dashboard</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/adminDashboardStyling.css">
    <link rel="stylesheet" href="css/headerFooter.css">
    <!-- Stylesheets -->

    <!-- Scripts -->
    <script src="script/adminDashboardScript.js"></script>
    <!-- Scripts -->

    <?php include("php/adminAction.php"); ?>
    <?php include("php/dbConnect.php"); ?>

    <meta content="width=device-width, initial-scale=1" name="viewport" />
</head>
<body>
    <header>
        <h1><a href="browseTickets.php" style="color: inherit; text-decoration: none;">TicketHub</a></h1>
        <ul>
            <li><a href="admin_personalinfo.php">Admin @<?php echo $username ?></a></li> <!-- UPDATE W/ CORRECT LINK  -->
        </ul>
    </header>
    <div class="adminContainer">
        <h3>Administrator Dashboard</h3>
        <div class="tabs">
            <div class="tab active" onclick="showTab('users')">Users</div>
            <div class="tab" onclick="showTab('sales')">Average Sales</div>
            <div class="tab" onclick="showTab('requests')">User Requests</div>
        </div>
        <!-- TODO: REPLACE THIS CONTENT WITH REAL DATA FROM THE DB -->
        <div class="tab-content active" id="users">
            <table>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                <?php
                    displayUsers($connection); // Call the function to display users
                ?>
            </table>
        </div>

        <div class="tab-content" id="sales">
            <table>
                <tr>
                    <th>Month-Year</th>
                    <th>Average Sales</th>
                </tr>
               <?php 
                    displayAverageSales($connection);
               ?>
            </table>
        </div>
        <div class="tab-content" id="requests">
            <table>
                <tr>
                    <th>User ID</th>
                    <th>Request</th>
                    <th>Status</th>
                    <th>Approve</th>
                </tr>
               <?php 
                    displayUserReqs($connection);
               ?>
            </table>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
    </footer>

    <?php mysqli_close($connection); ?>
</body>
</html>

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

       // Initialize $event as an empty array
        $event = [];

        // Retrieve the EventID from the form submission
        if (isset($_POST['eventID'])) {
            $eventID = $_POST['eventID'];
            // Use $eventID to fetch the event details from the database and populate the form for editing
            include("php/dbConnect.php");
            $sql = "SELECT e.EventID, e.EventName, e.Location, e.DateTime,
                           inv.TicketQty,
                           ti.Price
                    FROM event e 
                    JOIN ticketinfo ti ON e.EventId = ti.EventId
                    JOIN ticketinventory inv ON ti.TicketId = inv.TicketId
                    WHERE e.EventID = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $eventID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $event = mysqli_fetch_assoc($result);
            
            // Close the database connection
            mysqli_free_result($result);
            mysqli_close($connection);
        }
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Event - Seller</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/sellerEditEvent.css">
    <link rel="stylesheet" href="css/headerFooter.css">
</head>
<body>
    <header>
        <h1><a href="browseTickets.php" style="color: inherit; text-decoration: none;">TicketHub</a></h1>
        <ul>
            <li><a href="sellerPersonalInfo.php">@<?php echo $username; ?></a></li>
        </ul>
    </header>
    
    <div class="editEventContainer">
        <?php if (!empty($event)): ?>
        <h3>Edit Event: <?php echo $event['EventName']; ?></h3>
        <!-- Populate the form fields with the event details fetched from the database -->
        <form action="php/sellerUpdateEvent.php" method="post">
            <input type="hidden" name="eventID" value="<?php echo $event['EventID']; ?>">
            
            <label for="eventName">Event Name:</label>
            <input type="text" id="eventName" name="eventName" value="<?php echo $event['EventName']; ?>"><br>
            <span class="error"><?php if(isset($validationResult['eventName'])) { echo $validationResult['eventName']; } ?></span><br>
            
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="<?php echo $event['Location']; ?>"><br>
            <span class="error"><?php if(isset($validationResult['location'])) { echo $validationResult['location']; } ?></span><br>
            
            <label for="dateTime">Date and Time:</label>
            <input type="datetime-local" id="dateTime" name="dateTime" value="<?php echo date('Y-m-d\TH:i', strtotime($event['DateTime'])); ?>"><br>
            <span class="error"><?php if(isset($validationResult['dateTime'])) { echo $validationResult['dateTime']; } ?></span><br>
            
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo $event['TicketQty']; ?>"><br>
            <span class="error"><?php if(isset($validationResult['quantity'])) { echo $validationResult['quantity']; } ?></span><br>
            
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" value="<?php echo $event['Price']; ?>"><br>
            <span class="error"><?php if(isset($validationResult['price'])) { echo $validationResult['price']; } ?></span><br>
            
            <input type="submit" value="Save Changes">
        </form>

        <?php else: ?>
        <p>Event not found!</p>
        <?php endif; ?>
    </div>
    
    <footer>
        <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
    </footer>
</body>
</html>
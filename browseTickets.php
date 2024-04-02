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


    <title>Concert Tickets</title>
     <!-- Stylesheets -->
     <link rel="stylesheet" href="css/browseTicketsStyling.css">
     <link rel="stylesheet" href="css/headerFooter.css">
     <!-- Stylesheets -->

     <!-- Script -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script>
        document.addEventListener('DOMContentLoaded', function() {
        var addToCartButtons = document.querySelectorAll('#addtocart');
        addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var eventName = button.getAttribute('EventName');
            $.post("addToCart.php", { EventName: eventName}, function(response) {
                alert("Added to Cart!");
            });
        });
        });
    });
     </script>
</head>
<body>
    <header>
        <h1><a href="browseTickets.php" style="color: inherit; text-decoration: none;">TicketHub</a></h1>
        <ul>
             <?php include("php/showLinks.php"); ?>

        </ul>
    </header>
    <div class="browseTicketsContainer">
        <h3>Upcoming Events</h3>
        <form method="post" action="browseTicketsResults.php">
            <div class="search-bar">
                <input type="text" id="query" name="search" placeholder="Search events...">
                <button id="search" type="submit">Search</button>
            </div>
        </form>
        <!-- Add more concert listings as needed -->
    </div>
    <?php
    include "php/dbConnect.php";

    $sql = "SELECT * FROM event JOIN ticketinfo on event.EventID = ticketinfo.EventID";

    $results = mysqli_query($connection, $sql);

    while($row = mysqli_fetch_assoc($results)) {
        echo "<div class='concert'>";
        echo "<h2>".$row['EventName']."</h2>";
        echo "<p>Date: ".$row['DateTime']."</p>";
        echo "<p>Location: ".$row['Location']."</p>";
        echo "<p>Price: ".$row['Price']."</p>";
        echo "<a id='addtocart' EventName='".$row['EventName']."' class='btn'>Add to Cart</a>";
        echo "</div>";
    }
    mysqli_free_result($results);
    mysqli_close($connection);
    ?>
</body>
<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>
</html>
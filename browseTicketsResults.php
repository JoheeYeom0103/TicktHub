<!DOCTYPE html>
<html>
<head>
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
             <!-- login? personinfo.html : login.html -->
            <li id="back"><a href="browseTickets.php">Back to Search</a></li>

            <li><a href="login.php">Login/Sign Up</a></li>
            <li><a href="shoppingcart.php">View Cart</a></li>  <!-- UPDATE W/ CORRECT LINK  -->

        </ul>
    </header>
    <div class="browseTicketsContainer">
        <h3>Upcoming Concerts</h3>
        <?php
    $search;

    if (isset($_POST["search"])) {
        $search = $_POST["search"];
    }

    include "php/dbConnect.php";
    $tickets = [];
    browseTickets($connection, $search);
    
    function browseTickets($connection, $search) {
        $sql = "SELECT * FROM event JOIN ticketinfo on event.EventID = ticketinfo.EventID WHERE EventName LIKE '%".$search."%'";

        $results = mysqli_query($connection, $sql);

        $tickets = [];

        while($row = mysqli_fetch_assoc($results)) {
            echo "<div class='concert'>";
            echo "<h2>".$row['EventName']."</h2>";
            echo "<p>Date: ".$row['DateTime']."</p>";
            echo "<p>Location: ".$row['Location']."</p>";
            echo "<p>Price: ".$row['Price']."</p>";
            echo "<a id='addtocart' EventName='".$row['EventName']."' class='btn'>Add to Cart</a>";
            echo "</div>";
            $tickets = $row['EventID'];
        }
        mysqli_free_result($results);
        mysqli_close($connection);

        return $tickets;
    }
    ?>
        <!-- Add more concert listings as needed -->
    </div>
</body>
<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>
</html>
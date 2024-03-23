<!DOCTYPE html>
<html>
<head>
    <title>Concert Tickets</title>

     <!-- Stylesheets -->
     <link rel="stylesheet" href="css/browseTicketsStyling.css">
     <link rel="stylesheet" href="css/headerFooter.css">
     <!-- Stylesheets -->
</head>
<body>
    <header>
        <h1><a href="browseTickets.php" style="color: inherit; text-decoration: none;">TicketHub</a></h1>
        <ul>
             <!-- login? personinfo.html : login.html -->
            <li><a href="login.php">Login/Sign Up</a></li>
            <li><a href="shoppingcart.php">View Cart</a></li> 
           
        </ul>
    </header>
    <div class="browseTicketsContainer">
        <h3>Upcoming Concerts</h3>
        <form class="search-bar" action="#" method="GET">
            <input type="text" name="search" placeholder="Search concerts...">
            <button type="submit">Search</button>
        </form>
        <div class="concert">
            <img src="concert1.jpg" alt="Concert 1">
            <h2>Artist Name</h2>
            <p>Date: January 1, 2025</p>
            <p>Location: Venue Name</p>
            <p>Price: $50</p>
            <a href="#" class="btn">Add to Cart</a> <!-- UPDATE W/ CORRECT LINK  -->
        </div>
        <div class="concert">
            <img src="concert2.jpg" alt="Concert 2">
            <h2>Artist Name</h2>
            <p>Date: January 2, 2025</p>
            <p>Location: Venue Name</p>
            <p>Price: $60</p>
            <a href="#" class="btn">Add to Cart</a> <!-- UPDATE W/ CORRECT LINK  -->
        </div>
        <div class="concert">
            <img src="concert3.jpg" alt="Concert 3">
            <h2>Artist Name</h2>
            <p>Date: January 3, 2025</p>
            <p>Location: Venue Name</p>
            <p>Price: $70</p>
            <a href="#" class="btn">Add to Cart</a> <!-- UPDATE W/ CORRECT LINK  -->
        </div>
        <!-- Add more concert listings as needed -->
    </div>
</body>
<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>
</html>

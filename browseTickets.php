<!DOCTYPE html>
<html>
<head>
    <title>Concert Tickets</title>

    <?php 
        // session logic
        session_start(); 
        if (isset($_SESSION["username"])){
            $username = $_SESSION["username"];
        }else{
            $username = "null";
        }
    ?>

     <!-- Stylesheets -->
     <link rel="stylesheet" href="css/browseTicketsStyling.css">
     <link rel="stylesheet" href="css/headerFooter.css">
     <!-- Stylesheets -->

     <!-- Script -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <h1><a href="browseTickets.php" style="color: inherit; text-decoration: none;">TicketHub</a></h1>
        <ul>
             <!-- login? personinfo.html : login.html -->
            <script>
                $(document).ready(function() {
                    $("#search").click(function() {
                        $("ul").append('<li id="back"><a href="browseTickets.php">Back to Search</a></li>');
                    });
                });
            </script>

            <?php include("php/showLinks.php"); ?>

        </ul>
    </header>
    <div class="browseTicketsContainer">
        <h3>Upcoming Concerts</h3>
        <div class="search-bar">
            <input type="text" id="query" name="search" placeholder="Search concerts...">
            <button id="search">Search</button>
        </div>
        <script>
            $(document).ready(function() {
                $("#search").click(function() {
                    var query = $("#query").val();
                    $.post("browsetickets.php", { UserQuery: query}, function(response) {
                        $(".browseTicketsContainer").html(response);
                    });
                });
            });
        </script>
        <!-- Add more concert listings as needed -->
    </div>
</body>
<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>
</html>
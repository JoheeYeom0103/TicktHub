<?php
    session_start();
    // DB connection information will be moved to central location!
    // Session variables subject to change
    // PaymentID and should be passed from previous pages?
    // No payment method selected handled?
    // Handle different tickets as separate transactions?
    $search, $UserID, $PaymentID;
    if (isset($_POST["UserQuery"])) {
        $search = $_POST["UserQuery"];
    }
    if (isset($_SESSION["UserID"])) {
        $UserID = $_SESSION["UserID"];
    }
    if (isset($_POST["PaymentID"])) {
        $PaymentID = $_POST["PaymentID"];
    }
    if (isset($_POST["TypesOfTicket"])) {
        $TypesOfTicket = $_POST["TypesOfTicket"];
    }
    $host = "localhost";
    $database = "cosc360";
    $user = "83066985";
    $password = "83066985";

    $connection = mysqli_connect($host, $user, $password, $database);

    $error = mysqli_connect_error();
    if($error != null)
    {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
    }
    else
    {
        // $TypesOfTicket is an array storing the all the ticketids within the order
        foreach ($TypesOfTicket as $Ticket) {
            $sql = "SELECT TicketID, Price FROM ticketinfo WHERE TicketID = '$Ticket'";

            $result = mysqli_query($connection, $sql);

            $row = mysqli_fetch_assoc($result);

            $Cost = $row['Price'];

            $OrderDateTime = date("y/m/d h:m:s");
            
            $sql = "INSERT INTO orders(UserID, PaymentID, TicketID, TicketQuantity, OrderCost, OrderDateTime, OrderStatus)
                    VALUES ($UserID, $PaymentID, $Ticket, $TicketQuantity, $Cost, $OrderDateTime, '1'";

            mysqli_query($connection, $sql);
        }
        
        mysqli_free_result($results);
        mysqli_close($connection);
    }
    ?>
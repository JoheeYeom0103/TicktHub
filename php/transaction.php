<?php
    session_start();
    include "dbConnect.php";
    
    // Declaring UserID, PaymentID, saved-payment-method as variable and TypesOfTicket and TicketQuantity as array
    $UserID;
    $PaymentID;
    $spm;
    $TypesOfTicket = [];
    $TicketQuantity = [];
    //transaction($connection);

    //function transaction($connection) {
        // Initialize UserID, PaymentID, and spm
        $UserID = isset($_SESSION['userId']) ? $_SESSION['userId'] : 1; 
        if (isset($_POST["PaymentID"])) {
            $PaymentID = $_POST["PaymentID"];
        }
        if (isset($_POST["saved-payment-method"])) {
            $spm = $_POST["saved-payment-method"];
        }

        // Get orderID
        $sql = "SELECT MAX(OrderID) as OrderID FROM orders";
        $results = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($results);
        $OrderID = $row['OrderID'] + 1;


        // Get payment method for UserID
        $sql = "SELECT * FROM payment WHERE UserID = '$UserID' AND PaymentMethod = '$spm'";
        $results = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($results);
        $PaymentID = $row['PaymentID'];

        // Get items from cart
        $sql = "SELECT * FROM cart WHERE UserID = '$UserID'";
        $results = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($results)) {
            $TypesOfTicket[] = $row['TicketID'];
            $TicketQuantity[] = $row['Quantity'];
        }
        // $TypesOfTicket is an array storing the all the ticketids within the order
        for ($x = 0; $x < sizeof($TypesOfTicket); $x++) {

            // For each ticket in the order, get id and quantity for insertion into the table
            $Ticket = $TypesOfTicket[$x];
            $Quantity = $TicketQuantity[$x];

            // Get price of each ticket in cart
            $sql = "SELECT TicketID, Price FROM ticketinfo WHERE TicketID = '$Ticket'";
            $results = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($results);

            // Get total cost of each ticket with quantity
            $Cost = $row['Price'] * $Quantity;

            // Current date as order date time
            $OrderDateTime = date("y/m/d h:m:s");

            // Insert into orders table
            $sql = "INSERT INTO orders(UserID, PaymentID, TicketID, TicketQuantity, OrderCost, OrderDateTime, OrderStatus)
                    VALUES ('$UserID', '$PaymentID', '$Ticket', '$Quantity', '$Cost', '$OrderDateTime', '1')";

            mysqli_query($connection, $sql);
        }
    // }
    mysqli_free_result($results);
    mysqli_close($connection);
    
    header('Location: ../orderconfirm.php');
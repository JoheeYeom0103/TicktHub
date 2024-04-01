<?php

function getTickets($username) {
    // connect to DB
    include("dbConnect.php");
    // return all tickets purchased by the user with the username that matches
    // the session variable $username
    $query = "SELECT ti.TicketName, e.Location, e.DateTime, o.TicketQuantity, o.OrderCost
            FROM Orders o
            JOIN TicketInfo ti ON o.TicketID = ti.TicketID
            JOIN Event e ON ti.EventID = e.EventID
            JOIN User u ON o.UserID = u.UserID
            WHERE u.Username = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die('Query failed: ' . mysqli_error($connection));
    }
        // get the list of results
        return $result;
}

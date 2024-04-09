<?php

function displaySellerSales($username, $connection){
    // Query the DB to access the average ticket price per month/year
    $sql = "SELECT MONTH(o.OrderDateTime) AS Month, 
    YEAR(o.OrderDateTime) AS Year, 
    COUNT(o.OrderID) AS TotalSales, 
    AVG(o.OrderCost) AS AverageSale 
    FROM orders o 
    JOIN seller s ON o.userID = s.SellerID
    JOIN user u ON u.userID = s.SellerID
    WHERE u.username = ?;";

    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    // Fetch and display results
    while ($row = mysqli_fetch_assoc($results)) {
        $year = $row['Year'];
        $month = $row['Month'];
        $sales = $row['AverageSale'];

        echo "<tr>
                <td>" . date('M Y', mktime(0, 0, 0, $month, 1, $year)) . "</td>". 
                "<td>" . number_format($sales, 2) . "</td>". 
             "</tr>";
    }

    mysqli_free_result($results);
}

function displayEvents($username, $connection){

    // Query to fetch the seller's current events
    $sql = "SELECT 
                e.EventID,
                e.EventName,
                e.Location,
                e.DateTime,
                inv.TicketQty AS Quantity,
                ti.Price,
                inv.TicketStatus
            FROM event e
            JOIN ticketinfo ti ON e.EventID = ti.EventID
            JOIN ticketinventory inv ON ti.TicketID = inv.TicketID
            JOIN user u ON e.SellerID = u.UserID
            WHERE u.username = ?";

    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    //echo "<br>RESULTS:" . mysqli_fetch_assoc($results);

    // Fetch and display results
    while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr>
                <td>" . $row['EventName'] . "</td>
                <td>" . $row['Location'] . "</td>
                <td>" . $row['DateTime'] . "</td>
                <td>" . $row['Quantity'] . "</td>
                <td>" . $row['Price'] . "</td>
                <td>" . $row['TicketStatus'] . "</td>
                <td>
                    <form action='seller_EditEvent.php' method='post'>
                        <input type='hidden' name='eventID' value='" . $row['EventID'] . "'>
                        <input type='submit' value='Edit'>
                    </form>
                </td>
                <td>
                    <form action='php/sellerDeleteEvent.php' method='post'>
                        <input type='hidden' name='eventID' value='" . $row['EventID'] . "'>
                        <input type='submit' value='Delete'>
                    </form>
                </td>
             </tr>";
    }

    mysqli_free_result($results);
}







<?php
include "dbConnection.php";

$EventName;
if (isset($_POST['EventName'])) {
    $EventName = $_POST['EventName'];
}
$sql = "SELECT * FROM event JOIN ticketinfo on event.EventID = ticketinfo.EventID WHERE EventName = '$EventName'";
            
$results = mysqli_query($connection, $sql);

$row = mysqli_fetch_assoc($results);

$TicketID = $row['TicketID'];

$TicketName = $row['TicketName'];

$Quantity = 1;

$Price = $row['Price'];

$sql = "INSERT INTO cart(TicketID, TicketName, Quantity, Price)
        VALUES ('$TicketID', '$TicketName', '$Quantity', '$Price')
        ON DUPLICATE KEY UPDATE
        Quantity=Quantity+1";

mysqli_query($connection, $sql);

mysqli_close($connection);
?>
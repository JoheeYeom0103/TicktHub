<?php
include "dbConnection.php";

$EventID;
if (isset($_POST['EventID'])) {
    $EventID = $_POST['EventID'];
}
$sql = "SELECT * FROM event JOIN ticketinfo on event.EventID = ticketinfo.EventID WHERE event.EventID = '$EventID'";
            
$results = mysqli_query($connection, $sql);

$row = mysqli_fetch_assoc($results);

$TicketID = $row['TicketID'];

$TicketName = $row['TicketName'];

$TicketName = mysqli_real_escape_string($connection, $TicketName);

$Quantity = 1;

$Price = $row['Price'];

$sql = "INSERT INTO cart(TicketID, TicketName, Quantity, Price)
        VALUES ('$TicketID', '$TicketName', '$Quantity', '$Price')
        ON DUPLICATE KEY UPDATE
        Quantity=Quantity+1, Price=(SELECT Price FROM ticketinfo WHERE TicketID = 'TicketID')*Quantity";

mysqli_query($connection, $sql);

mysqli_free_result($results);

mysqli_close($connection);
?>
<?php
include "dbConnect.php";

// Assuming you have a database connection named $conn
$username = $_SESSION["username"];
$sql1 = "SELECT userID FROM user WHERE username = ?";
$stmt = $connection->prepare($sql1);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$userID = $result->fetch_assoc()['userID'];

$EventID;
if (isset($_POST['EventID'])) {
    $EventID = $_POST['EventID'];
}

$sql = "SELECT * FROM event JOIN ticketinfo on event.EventID = ticketinfo.EventID WHERE event.EventID = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $EventID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$TicketID = $row['TicketID'];
$TicketName = mysqli_real_escape_string($connection, $row['TicketName']);
$Quantity = 1;
$Price = $row['Price'];

// Use parameterized query to insert data into cart table
$sql = "INSERT INTO cart(UserID, TicketID, TicketName, Quantity, Price)
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
        Quantity=Quantity+1, Price=(SELECT Price FROM ticketinfo WHERE TicketID = ?)*Quantity";

$stmt = $connection->prepare($sql);
$stmt->bind_param("iisidi", $userID, $TicketID, $TicketName, $Quantity, $Price, $TicketID);
$stmt->execute();

$stmt->close();
$connection->close();
?>

<?php
require_once("dbConnectM.php");
session_start();

// Retrieve SellerID from session or set a default value
if (isset($_SESSION["SellerID"])) {
    $sellerID = $_SESSION["SellerID"];
} else {
    // Set a default SellerID
    $sellerID = 1; // You may adjust this value as needed
}
if (isset($_SESSION["AdminID"])) {
    $adminID = $_SESSION["AdminID"];
} else {
    // Set a default AdminID
    $adminID = 4; // You may adjust this value as needed
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST["eventName"];
    $location = $_POST["location"];
    $dateTime = $_POST["dateTime"];
    $quantity = $_POST["quantity"];
    $cost = $_POST["cost"];
    $description = $_POST["description"];

    // Prepare and execute the SQL statements
    $stmt = $conn->prepare("INSERT INTO Event (AdminID, Status, EventName, Location, DateTime) VALUES (?, ?, ?, ?, ?)");
    $status = 'Pending'; // Set the status to "Pending"
    $stmt->bind_param("issss", $adminID, $status, $eventName, $location, $dateTime);

    if ($stmt->execute()) {
        $eventID = $stmt->insert_id;

        $stmt2 = $conn->prepare("INSERT INTO TicketInfo (SellerID, EventID, TicketName, TicketDescription, Price) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("iissd", $sellerID, $eventID, $eventName, $description, $cost);

        if ($stmt2->execute()) {
            echo "Event created successfully!";
        } else {
            echo "Error creating ticket info: " . $stmt2->error;
        }

        $stmt2->close();
    } else {
        echo "Error creating event: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>

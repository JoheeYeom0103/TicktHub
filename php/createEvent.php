<?php
session_start();

require_once("dbConnect.php"); // Include dbConnect.php file

class EventCreator {
    private $connection; // Rename $conn to $connection
    private $sellerID;
    private $adminID;

    public function __construct($connection) { // Rename $conn to $connection
        $this->connection = $connection; // Rename $conn to $connection
        // Retrieve SellerID from session or set a default value
        $this->sellerID = isset($_SESSION["SellerID"]) ? $_SESSION["SellerID"] : 1; // Default value: 1
        // Retrieve AdminID from session or set a default value
        $this->adminID = isset($_SESSION["AdminID"]) ? $_SESSION["AdminID"] : 4; // Default value: 4
    }

    public function createEvent($eventName, $location, $dateTime, $quantity, $cost, $description) {
        $stmt = $this->connection->prepare("INSERT INTO Event (AdminID, Status, EventName, Location, DateTime) VALUES (?, ?, ?, ?, ?)");
        $status = 'Pending'; 
        $stmt->bind_param("issss", $this->adminID, $status, $eventName, $location, $dateTime);

        if ($stmt->execute()) {
            $eventID = $stmt->insert_id;

            if ($this->createTicketInfo($eventID, $eventName, $description, $cost)) {
                header("Location: ../salesManageEvents.php");
                exit(); // Stop further execution
            } else {
                return "Error creating ticket info.";
            }
        } else {
            return "Error creating event.";
        }
    }

    public function createTicketInfo($eventID, $ticketName, $ticketDescription, $price) {
        $stmt = $this->connection->prepare("INSERT INTO ticketinfo (SellerID, EventID, TicketName, TicketDescription, Price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iissd", $this->sellerID, $eventID, $ticketName, $ticketDescription, $price);

        return $stmt->execute();
    }
}

// Usage
$eventCreator = new EventCreator($connection); // Pass $connection variable to EventCreator constructor

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST["eventName"];
    $location = $_POST["location"];
    $dateTime = $_POST["dateTime"];
    $quantity = $_POST["quantity"];
    $cost = $_POST["cost"];
    $description = $_POST["description"];

    echo $eventCreator->createEvent($eventName, $location, $dateTime, $quantity, $cost, $description);
} else {
    echo "Invalid request method.";
}

$connection->close(); // Close the database connection

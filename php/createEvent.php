<?php
session_start();

class EventCreator {
    private $conn;
    private $sellerID;
    private $adminID;

    public function __construct($conn) {
        $this->conn = $conn;
        // Retrieve SellerID from session or set a default value
        $this->sellerID = isset($_SESSION["SellerID"]) ? $_SESSION["SellerID"] : 1; // Default value: 1
        // Retrieve AdminID from session or set a default value
        $this->adminID = isset($_SESSION["AdminID"]) ? $_SESSION["AdminID"] : 4; // Default value: 4
    }

    public function createEvent($eventName, $location, $dateTime, $quantity, $cost, $description) {
        $stmt = $this->conn->prepare("INSERT INTO Event (AdminID, Status, EventName, Location, DateTime) VALUES (?, ?, ?, ?, ?)");
        $status = 'Pending'; 
        $stmt->bind_param("issss", $this->adminID, $status, $eventName, $location, $dateTime);

        if ($stmt->execute()) {
            $eventID = $stmt->insert_id;

            if ($this->createTicketInfo($eventID, $eventName, $description, $cost)) {
                header("Location: ../salesManageEvents.html");
                exit(); // Stop further execution
            } else {
                return "Error creating ticket info.";
            }
        } else {
            return "Error creating event.";
        }
    }

    public function createTicketInfo($eventID, $ticketName, $ticketDescription, $price) {
        $stmt = $this->conn->prepare("INSERT INTO TicketInfo (SellerID, EventID, TicketName, TicketDescription, Price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iissd", $this->sellerID, $eventID, $ticketName, $ticketDescription, $price);

        return $stmt->execute();
    }
}

// Usage
require_once("dbConnectM.php");
$eventCreator = new EventCreator($conn);

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

$conn->close();
?>

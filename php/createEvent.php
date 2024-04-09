<?php
session_start();

require_once("dbConnect.php"); // Include dbConnect.php file

class EventCreator {
    private $connection; // Rename $conn to $connection
    private $sellerID;
    private $adminID;

    public function __construct($connection) { // Rename $conn to $connection
        $this->connection = $connection; // Rename $conn to $connection
    
        // Retrieve AdminID from session or set a default value
        $this->adminID = isset($_SESSION["AdminID"]) ? $_SESSION["AdminID"] : 4; // Default value: 4
    }

    public function createEvent($eventName, $location, $dateTime, $quantity, $cost, $description) {
        $stmt = $this->connection->prepare("INSERT INTO Event (AdminID, Status, EventName, Location, DateTime, SellerID) VALUES (?, ?, ?, ?, ?, ?)");
        $status = 'Pending'; 
        $overdue = 'false';
        $sellerId = 2;
        $stmt->bind_param("issssi", $this->adminID, $status, $eventName, $location, $dateTime, $sellerId);

        if ($stmt->execute()) {
            $eventID = $stmt->insert_id;
            $ticketID = $stmt->insert_id;
            echo "New record has id: " . $stmt -> insert_id;


            if ($this->createTicketInfo($eventID, $eventName, $description, $cost) && $this->createTicketInv($ticketID, $quantity, $status, $overdue)) {
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
        $seller_ID = 2;
        $stmt->bind_param("iissd", $seller_ID, $eventID, $ticketName, $ticketDescription, $price);
        return $stmt->execute();
    }

    public function createTicketInv($ticketID, $quantity, $ticketStatus, $isOverdue){
        $stmt = $this->connection->prepare("INSERT INTO ticketinventory (SellerID, TicketID, TicketQty, TicketStatus, IsOverdue) VALUES (?, ?, ?, ?, ?)");
        $sellerID = 2; // Assuming the seller ID is fixed for this operation
        $stmt->bind_param("iiiss", $sellerID, $ticketID, $quantity, $ticketStatus, $isOverdue);
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

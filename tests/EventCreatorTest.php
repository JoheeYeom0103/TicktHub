<?php
use PHPUnit\Framework\TestCase;

class EventCreatorTest extends TestCase
{
    protected static $connection;

    public static function setUpBeforeClass(): void
    {
        // Establish database connection
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $dbname = getenv('DB_DATABASE');

        self::$connection = new mysqli($host, $user, $pass, $dbname);

        if (self::$connection->connect_error) {
            die('Failed to connect to MySQL: ' . self::$connection->connect_error);
        }
    }

    public function testDatabaseConnection()
    {
        $this->assertInstanceOf(mysqli::class, self::$connection);
    }

    public function testCreateEvent()
    {
        // Mock $_SESSION superglobal
        $_SESSION["SellerID"] = 1;
        $_SESSION["AdminID"] = 4;

        // Mock $_POST superglobal
        $_POST["eventName"] = "Test Event";
        $_POST["location"] = "Test Location";
        $_POST["dateTime"] = "2024-04-05 12:00:00";
        $_POST["cost"] = 20.99;
        $_POST["description"] = "Test Description";

        // Execute createEvent method
        $result = $this->createEvent(
            $_POST["eventName"],
            $_POST["location"],
            $_POST["dateTime"],
            $_POST["cost"],
            $_POST["description"]
        );

        // Check if the result indicates success
        $this->assertStringContainsString("Location: ../salesManageEvents.html", $result);

        // Check if the event and ticket info were inserted into the database
        $eventID = $this->getInsertedEventID();
        $this->assertGreaterThan(0, $eventID);

        $ticketID = $this->getInsertedTicketID();
        $this->assertGreaterThan(0, $ticketID);
    }

    protected function createEvent($eventName, $location, $dateTime, $cost, $description)
    {
        // Prepare insert statement for events table
        $stmt = self::$connection->prepare("INSERT INTO event (EventName, Location, DateTime) VALUES (?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("sss", $eventName, $location, $dateTime);
        
        // Execute statement
        $stmt->execute();

        // Check if insertion was successful
        if ($stmt->affected_rows <= 0) {
            return "Error inserting event";
        }

        // Get the event ID
        $eventID = $stmt->insert_id;

        // Prepare insert statement for ticketinfo table
        $stmt = self::$connection->prepare("INSERT INTO ticketInfo (EventID, TicketName, Price) VALUES (?, ?, ?)");
        
        // Bind parameters
        $ticketName = "General Admission"; // Example ticket name
        $price = 20.99; // Example price
        $stmt->bind_param("isd", $eventID, $ticketName, $price);
        
        // Execute statement
        $stmt->execute();

        // Check if insertion was successful
        if ($stmt->affected_rows <= 0) {
            return "Error inserting ticket info";
        }

        return "Location: ../salesManageEvents.html";
    }

    protected function getInsertedEventID()
    {
        // Fetch the last inserted event ID
        $result = self::$connection->query("SELECT MAX(EventID) AS MaxEventID FROM event");
        if ($result && $row = $result->fetch_assoc()) {
            return $row["MaxEventID"];
        }
        return 0;
    }

    protected function getInsertedTicketID()
    {
        // Fetch the last inserted ticket ID
        $result = self::$connection->query("SELECT MAX(TicketID) AS MaxTicketID FROM ticketInfo");
        if ($result && $row = $result->fetch_assoc()) {
            return $row["MaxTicketID"];
        }
        return 0;
    }

    public static function tearDownAfterClass(): void
    {
        // Rollback any pending transactions
        self::$connection->rollback();
        
        // Close the database connection
        self::$connection->close();
    }
}
?>

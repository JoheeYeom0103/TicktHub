<?php
use PHPUnit\Framework\TestCase;

require_once "php/adminAction.php";

class AdminTest extends TestCase
{
    protected $connection;

    protected function setUp(): void {
        // Get database connection parameters from environment variables
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME'); 
        $pass = getenv('DB_PASSWORD'); 
        $dbname = getenv('DB_DATABASE');

        // Create a mysqli connection
        $this->connection = new mysqli($host, $user, $pass, $dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    protected function tearDown(): void {
        // Close database connection after each test
        $this->connection->close();
    }

    public function testDisplayUsers()
    {
        // Call the displayUsers function with the mysqli connection
        ob_start();
        displayUsers($this->connection);
        $output = ob_get_clean();

        // Assert not empty
        $this->assertNotEmpty($output);
    }

   public function testDisplayAverageSales()
    {
        try {
            // Start output buffering
            ob_start();
    
            // Call the displayAverageSales function with the mysqli connection
            displayAverageSales($this->connection);
    
            // Get the contents of the output buffer
            $output = ob_get_clean();
    
            // Assertions on the output
            $this->assertNotEmpty($output);
    
        } catch (Exception $e) {
            // If an exception is thrown, fail the test and display the exception message
            $this->fail("An exception was thrown: " . $e->getMessage());
        } finally {
            // Ensure the output buffer is closed even if an exception occurs
            ob_end_clean();
        }
    }

    public function testDisplayUserReqs()
    {
        // Create a test event
        $eventName = "Test Event";
        $sql = "INSERT INTO event (EventName, Status) VALUES ('$eventName', 'Pending')";
        mysqli_query($this->connection, $sql);

        // Simulate approving the test event
        $_POST['eventId'] = mysqli_insert_id($this->connection); // Get the ID of the last inserted event
        $_POST['action'] = 'Approve';
        ob_start();
        displayUserReqs($this->connection);
        $output = ob_get_clean();

        // Check if the status of the event is updated to 'Approved'
        $sql = "SELECT Status FROM event WHERE EventName = '$eventName'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $this->assertEquals('Approved', $row['Status']);

        // Simulate rejecting the test event
        $_POST['action'] = 'Reject';
        ob_start();
        displayUserReqs($this->connection);
        $output = ob_get_clean();

        // Check if the status of the event is updated to 'Rejected'
        $sql = "SELECT Status FROM event WHERE EventName = '$eventName'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $this->assertEquals('Rejected', $row['Status']);

        // Clean up: delete the test event
        $eventId = $_POST['eventId'];
        $sql = "DELETE FROM event WHERE EventID = $eventId";
        mysqli_query($this->connection, $sql);

        // Assert that the table isn't empty
        $this->assertNotEmpty($output);
    }
}

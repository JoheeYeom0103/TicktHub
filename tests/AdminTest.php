<?php
use PHPUnit\Framework\TestCase;

require_once "php/adminAction.php";

class AdminTest extends TestCase
{
    // function to test the display users function in the adminAction.php file
    public function testDisplayUsers()
    {
        // Get database connection parameters from environment variables
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWD');
        $dbname = getenv('DB_DBNAME');

        // Create a mysqli connection
        $connection = new mysqli($host, $user, $pass, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Call the displayUsers function with the mysqli connection
        ob_start();
        displayUsers($connection);
        $output = ob_get_clean();

        // Assert not empty
        $this->assertNotEmpty($output);
    }

    public function testDisplayAverageSales()
    {
        // Get database connection parameters from environment variables
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWD');
        $dbname = getenv('DB_DBNAME');

        // Create a mysqli connection
        $connection = new mysqli($host, $user, $pass, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        try {
            // Call the displayAverageSales function with the mysqli connection
            ob_start();
            displayAverageSales($connection);
            $output = ob_get_clean();

            // Assertions on the output
            $this->assertNotEmpty($output);

            // catch any exceptions thrown during method execution
        } catch (Exception $e) {
            $this->fail("An exception was thrown: " . $e->getMessage());
        }
    }

    public function testDisplayUserReqs()
    {
        // Get database connection parameters from environment variables
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWD');
        $dbname = getenv('DB_DBNAME');

        // Create a mysqli connection
        $connection = new mysqli($host, $user, $pass, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Create a test event
        $eventName = "Test Event";
        $sql = "INSERT INTO Event (EventName, Status) VALUES ('$eventName', 'Pending')";
        mysqli_query($connection, $sql);

        // Simulate approving the test event
        $_POST['eventId'] = mysqli_insert_id($connection); // Get the ID of the last inserted event
        $_POST['action'] = 'Approve';
        ob_start();
        displayUserReqs($connection);
        $output = ob_get_clean();

        // Check if the status of the event is updated to 'Approved'
        $sql = "SELECT Status FROM Event WHERE EventName = '$eventName'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $this->assertEquals('Approved', $row['Status']);

        // Simulate rejecting the test event
        $_POST['action'] = 'Reject';
        ob_start();
        displayUserReqs($connection);
        $output = ob_get_clean();

        // Check if the status of the event is updated to 'Rejected'
        $sql = "SELECT Status FROM Event WHERE EventName = '$eventName'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $this->assertEquals('Rejected', $row['Status']);

        // Clean up: delete the test event
        $eventId = $_POST['eventId'];
        $sql = "DELETE FROM Event WHERE EventID = $eventId";
        mysqli_query($connection, $sql);

        // Assert that the table isn't empty
        $this->assertNotEmpty($output);
    }

}



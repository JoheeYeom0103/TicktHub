<?php
use PHPUnit\Framework\TestCase;
require_once "php/transaction.php";

class TransactionTest extends TestCase {

    protected static $connection;

    // Set up database connection
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

    // Test the transaction method
    public function testTransaction() {

        // Get the connection
        $conn = self::$connection;

        // Call the method with the default values
        $result = transaction($conn);

        // No errors have occurred
        $this->assertNull($result);
        
    }

    public function testBrowseTickets() {
        
        // Get the connection
        $conn = self::$connection;

        // Run query to display all events, all output is added to $output
        $sql = "SELECT * FROM event JOIN ticketinfo on event.EventID = ticketinfo.EventID";

        $results = mysqli_query($conn, $sql);

        $output = '';

        while($row = mysqli_fetch_assoc($results)) {
            $output .= "<div class='concert'>";
            $output .= "<h2>".$row['EventName']."</h2>";
            $output .= "<p>Date: ".$row['DateTime']."</p>";
            $output .= "<p>Location: ".$row['Location']."</p>";
            $output .= "<p>Price: ".$row['Price']."</p>";
            $output .= "<a id='addtocart' EventID='".$row['EventID']."' class='btn'>Add to Cart</a>";
            $output .= "</div>";
        }

        // Assert that the output is filled
        $this->assertNotNull($output);
        
    }

    public function testCartRemoval() {

        // Get the connection
        $conn = self::$connection;

        // Call the tested function with default values
        $result = removeFromCart($conn);

        // Assert that no errors occurred
        $this->assertNull($result);
    }

    public static function tearDownAfterClass(): void
    {
        // Close the database connection
        self::$connection->close();
    }
}
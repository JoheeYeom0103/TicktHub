<?php
use PHPUnit\Framework\TestCase;

require_once "php/salesManageEventsAction.php";

class ManageEventsTest extends TestCase
{
    protected $seller;
    protected $connection;

    protected function setUp(): void
    {
        parent::setUp();

        // putenv('DB_HOST=localhost');
        // putenv('DB_USERNAME=tatkg24');
        // putenv('DB_PASSWORD=C0sc360!!');
        // putenv('DB_DATABASE=tickethub');
        
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

        $this->seller = "jane_smith"; // Set the seller username here
    }

    protected function tearDown(): void {
        // Close database connection after each test
        $this->connection->close();
    }

    public function testDisplaySellerSales()
    {
        // Start output buffering
        ob_start();
        // Call the displaySellerSales function with the mysqli connection
        displaySellerSales($this->seller, $this->connection); // username is an actual username
        // Get the output and stop output buffering
        $output = ob_get_clean();

        // assert that the output string isn't empty
        $this->assertNotEmpty($output); 
    }


    public function testDisplayEvents()
    {
        // Call the displayEvents function for the test seller
        ob_start();
        displayEvents($this->seller, $this->connection);
        $output = ob_get_clean();

        // assert that the table isnt empty
        $this->assertNotEmpty($output);
    }
}

<?php
use PHPUnit\Framework\TestCase;

require_once "php/salesManageEventsAction.php";

class ManageEventsTest extends TestCase
{
    protected $seller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seller = "jane_smith"; // Set the seller username here
    }

    public function testDisplaySellerSales()
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

        // Call the displaySellerSales function with the mysqli connection
        ob_start();
        displaySellerSales($this->seller, $connection); // username is an actual username
        $output = ob_get_clean();

        // assert that the table isnt empty
        $this->assertNotEmpty($output); 
    }

    public function testDisplayEvents()
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

    // Call the displayEvents function for the test seller
    ob_start();
    displayEvents($this->seller, $connection);
    $output = ob_get_clean();

    // assert that the table isnt empty
    $this->assertNotEmpty($output);
}

}
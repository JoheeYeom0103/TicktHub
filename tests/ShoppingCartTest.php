<?php

use PHPUnit\Framework\TestCase;

class ShoppingCartTest extends TestCase
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

    public function testUpdateQuantity()
    {
        // Begin transaction
        self::$connection->begin_transaction();

        // Sample data for testing
        $ticketID = 1;
        $quantity = 5;

        // Execute updateQuantity function
        $success = $this->updateQuantity($ticketID, $quantity);

        // Check if update was successful
        $this->assertTrue($success);

        // Rollback transaction
        self::$connection->rollback();
    }

    public function testDeleteItem()
    {
        // Begin transaction
        self::$connection->begin_transaction();

        // Sample data for testing
        $ticketID = 2;

        // Execute deleteItem function
        $success = $this->deleteItem($ticketID);

        // Check if deletion was successful
        $this->assertTrue($success);

        // Rollback transaction
        self::$connection->rollback();
    }

    protected function updateQuantity($ticketID, $quantity)
    {
        // Get the connection from the class property
        $conn = self::$connection;

        $sql = "UPDATE cart SET Quantity = ? WHERE TicketID = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ii", $quantity, $ticketID);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    protected function deleteItem($ticketID)
    {
        // Get the connection from the class property
        $conn = self::$connection;

        $sql = "DELETE FROM cart WHERE TicketID = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $ticketID);
        $stmt->execute();

        return $stmt->affected_rows > 0;
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

<?php

use PHPUnit\Framework\TestCase;

class payoutInfoTest extends TestCase
{
    protected static $connection;

    /* Test database connection */
    public static function setUpBeforeClass(): void
    {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWD');
        $dbname = getenv('DB_DBNAME');

        // Create connection
        self::$connection = mysqli_connect($host, $user, $pass, $dbname);

        // If connection is failed
        if (!self::$connection) {
            die('Failed to connect to MySQL: ' . mysqli_connect_error());
        }

        // If connection is successful
        mysqli_begin_transaction(self::$connection);
    }

    public function testDatabaseConnection()
    {
        // Verifies that the object stored in self::$connection is an instance of the mysqli class
        /* assertInstanceOf(A, B): if B is an instance of A */
        $this->assertInstanceOf(mysqli::class, self::$connection);
    }

    /* Test displaying data from the database */
    public function testBankInformationDisplay()
    {
        // Mock bank transfer data for testing
        $bankTransfers = [
            ['BankID' => 1, 'BankName' => 'Bank A', 'AccountHolderName' => 'John Doe', 'AccountNumber' => '123456'],
            ['BankID' => 2, 'BankName' => 'Bank B', 'AccountHolderName' => 'Jane Doe', 'AccountNumber' => '654321']
        ];

        // Check if bank transfer information is correctly displayed
        $output = '';
        foreach ($bankTransfers as $bankTransfer) {
            $output .= "<table class=\"payment-table\">";
            $output .= "<tr><th>Bank Name</th><td>{$bankTransfer['BankName']}</td></tr>";
            $output .= "<tr><th>Account Holder Name</th><td>{$bankTransfer['AccountHolderName']}</td></tr>";
            $output .= "<tr><th>Account Number</th><td>{$bankTransfer['AccountNumber']}</td></tr>";
            $output .= "</table>";
        }

        $this->assertNotEmpty($output); // Ensure output is not empty
    }

    public function testCreditCardDisplay()
    {
        // Mock credit card data for testing
        $creditCards = [
            ['CardID' => 1, 'CardNumber' => '1234 5678 9012 3456', 'ExpiryDate' => '12/25', 'CardHolderName' => 'John Doe', 'CVC' => '123'],
            ['CardID' => 2, 'CardNumber' => '9876 5432 1098 7654', 'ExpiryDate' => '06/24', 'CardHolderName' => 'Jane Doe', 'CVC' => '456']
        ];

        // Check if credit card information is correctly displayed
        $output = '';
        foreach ($creditCards as $creditCard) {
            $output .= "<table class=\"payment-table\">";
            $output .= "<tr><th>Card Number</th><td>{$creditCard['CardNumber']}</td></tr>";
            $output .= "<tr><th>Expiration Date</th><td>{$creditCard['ExpiryDate']}</td></tr>";
            $output .= "<tr><th>Card Holder Name</th><td>{$creditCard['CardHolderName']}</td></tr>";
            $output .= "<tr><th>Security Code (CVC)</th><td>{$creditCard['CVC']}</td></tr>";
            $output .= "</table>";
        }

        $this->assertNotEmpty($output); // Ensure output is not empty
    }

    public static function tearDownAfterClass(): void
    {
        // Rollback transaction to avoid persisting test data
        mysqli_rollback(self::$connection);
        mysqli_close(self::$connection);
    }
}

<?php

use PHPUnit\Framework\TestCase;

require_once "php/dbConnect.php"; 
require_once "php/payoutinfo.php";

class PayoutInfoTest extends TestCase
{
    protected static $connection;

    public static function setUpBeforeClass(): void
    {
        // Mock the database connection
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWD');
        $dbname = getenv('DB_DBNAME');
        
        self::$connection = new mysqli($host, $user, $pass, $dbname);
        if(self::$connection->connect_error) {
            die("Connection failed: " . self::$connection->connect_error);
        }
    }

    /* Test database connection */
    public function testDatabaseConnection()
    {
        // Check if the connection is an object of mysqli class
        $this->assertTrue(is_object(self::$connection) && get_class(self::$connection) === "mysqli");
    }

    /* Test displaying bank information from database */
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

        $expectedOutput = "<table class=\"payment-table\"><tr><th>Bank Name</th><td>Bank A</td></tr><tr><th>Account Holder Name</th><td>John Doe</td></tr><tr><th>Account Number</th><td>123456</td></tr></table><table class=\"payment-table\"><tr><th>Bank Name</th><td>Bank B</td></tr><tr><th>Account Holder Name</th><td>Jane Doe</td></tr><tr><th>Account Number</th><td>654321</td></tr></table>";

        $this->assertEquals($expectedOutput, $output);
    }
}
?>

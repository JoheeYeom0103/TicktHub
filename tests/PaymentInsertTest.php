<?php

use PHPUnit\Framework\TestCase;

require_once "php/dbConnect.php"; 
require_once "php/addNewMethod_payment";

class PayoutInsertTest extends TestCase
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

    public function testDatabaseConnection()
    {
        // Check if the connection is an object of mysqli class
        $this->assertTrue(is_object(self::$connection) && get_class(self::$connection) === "mysqli");
    }

    public function testCreditCardInsertion()
    {
        // Mock credit card data for testing
        $creditCardData = [
            'CardNumber' => '1234567890123456',
            'ExpirationDate' => '2024-12-31',
            'CardHolderName' => 'John Doe',
            'CVC' => '123'
        ];

        // Prepare the SQL statement for inserting into CreditCard table
        $sql = "INSERT INTO CreditCard (UserID, CardNumber, ExpiryDate, CardHolderName, CVC)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare(self::$connection, $sql);

        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "issss", $userID, $creditCardData['CardNumber'], $creditCardData['ExpirationDate'], $creditCardData['CardHolderName'], $creditCardData['CVC']);

        // Execute the statement
        $success = mysqli_stmt_execute($stmt);

        // Check if the insertion is successful
        $this->assertTrue($success);

        // Close the statement
        mysqli_stmt_close($stmt);
    }

    public function testBankTransferInsertion()
    {
        // Mock bank transfer data for testing
        $bankTransferData = [
            'BankName' => 'Bank XYZ',
            'AccountHolderName' => 'Jane Doe',
            'AccountNumber' => '9876543210'
        ];

        // Prepare the SQL statement for inserting into BankTransfer table
        $sql = "INSERT INTO BankTransfer (UserID, BankName, AccountHolderName, AccountNumber)
                VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare(self::$connection, $sql);

        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "isss", $userID, $bankTransferData['BankName'], $bankTransferData['AccountHolderName'], $bankTransferData['AccountNumber']);

        // Execute the statement
        $success = mysqli_stmt_execute($stmt);

        // Check if the insertion is successful
        $this->assertTrue($success);

        // Close the statement
        mysqli_stmt_close($stmt);
    }

    // Add more test methods as necessary

    public static function tearDownAfterClass(): void
    {
        // Close the database connection after all tests are done
        mysqli_close(self::$connection);
    }
}
?>

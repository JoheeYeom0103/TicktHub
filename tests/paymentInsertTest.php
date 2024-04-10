<?php

use PHPUnit\Framework\TestCase;

class paymentInsertTest extends TestCase
{
    protected static $connection;

    /* Test database connection */
    public static function setUpBeforeClass(): void
    {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME'); 
        $pass = getenv('DB_PASSWORD'); 
        $dbname = getenv('DB_DATABASE');

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

     /* Test credit card data insertion */ 
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
         // assertTrue(mysqli_stmt_execute($stmt)): if execution is successful and returns true
         $this->assertTrue($success);
 
         // Close the statement
         mysqli_stmt_close($stmt);
     }

    /* Test credit card data insertion */
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

    public static function tearDownAfterClass(): void
    {
        // Close the database connection after all tests are done
        mysqli_close(self::$connection);
    }
}
?>

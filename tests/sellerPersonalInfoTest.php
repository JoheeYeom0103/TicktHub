<?php

use PHPUnit\Framework\TestCase;

require_once "php/dbConnect.php"; 
require_once "php/sellerPersonalInfo.php"; 

class SellerPersonalInfoTest extends TestCase
{
    protected static $connection;

    public static function setUpBeforeClass(): void
    {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWD');
        $dbname = getenv('DB_DBNAME');
        
        self::$connection = new mysqli($host, $user, $pass, $dbname);
        if (self::$connection->connect_error) {
            die("Connection failed: " . self::$connection->connect_error);
        }

        self::$connection->begin_transaction();
    }

    /* Test database connection */
    public function testDatabaseConnection()
    {
        $this->assertInstanceOf(mysqli::class, self::$connection);
    }

    /* Test form submission */
    public function testFormSubmission()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['userName'] = 'test_user';
        $_POST['firstName'] = 'Test';
        $_POST['middleName'] = 'Middle';
        $_POST['lastName'] = 'User';
        $_POST['password'] = 'testpassword';
        $_POST['email'] = 'test@example.com';
        $_POST['phoneNumber'] = '123-456-7890';
        $_POST['submit'] = true; // Simulate clicking the submit button

        // Temporarily replace the database connection in PersonalInfo_Action.php
        global $connection;
        $originalConnection = $connection;
        $connection = self::$connection;

        ob_start();
        include "app/PersonalInfo_Action.php"; // This includes your action script that handles the POST request
        $output = ob_get_clean();

        // Restore the original database connection just in case
        $connection = $originalConnection;

        $expectedOutput = "<script>alert('Changes have been successfully saved!'); window.location.href = 'buyerPersonalInfo.php';</script>";
        $this->assertEquals($expectedOutput, $output);
    }

    protected function tearDown(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_POST = [];
        if (ob_get_length()) ob_end_clean();
    }

    public static function tearDownAfterClass(): void
    {
        self::$connection->rollback();
        mysqli_close(self::$connection);
    }
}
?>

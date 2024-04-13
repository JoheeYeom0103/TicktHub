<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    protected static $connection;

    // Test Database Connection
    public static function setUpBeforeClass(): void
    {
        /* Use getenv for 
            * separation of configuration and code
            * Improved Security
            * Flexibility and Portability */

        // Get database connection environment from the phpunit.xml
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME'); 
        $pass = getenv('DB_PASSWORD'); 
        $dbname = getenv('DB_DATABASE');

        /*
            Note:   self:: for accessing static properties and methods
                    $this-> for accessing non-static properties or methods
        */
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

    public function testValidLogin()
    {
        // Assuming you have a database setup for testing
        // Replace 'test_user' and 'test_password' with valid test credentials
        $_POST['username'] = 'test_user';
        $_POST['password'] = 'test_password';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        // Prepare and execute the login action
        require_once 'php/loginAction.php';
        $result = login(self::$connection);

        // Assert that the result is not empty
        $this->assertNotEmpty($result);
    }

    // More tests can be added to cover different scenarios

    public static function tearDownAfterClass(): void
    {
        // Rollback transaction to avoid persisting test data
        mysqli_rollback(self::$connection);
        mysqli_close(self::$connection);
    }
}

?>

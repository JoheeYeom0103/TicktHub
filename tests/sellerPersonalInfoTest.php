User
<?php

use PHPUnit\Framework\TestCase;

class sellerPersonalInfoTest extends TestCase
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

    public function testInsertIntoDatabase()
    {
        // Sample data for insertion
        $username = 'testUser';
        $email = 'test@example.com';

        // Prepare and execute the insert query for the User table
        $stmt = mysqli_prepare(self::$connection, 'INSERT INTO User (Username, Email) VALUES (?, ?)');
        mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
        mysqli_stmt_execute($stmt);

        // Check if insert was successful
        /* mysqli_affected_rows($connection): return the number of rows affected after execution */
        $this->assertEquals(1, mysqli_affected_rows(self::$connection));

        // Verify the inserted data 
        $insertedId = mysqli_insert_id(self::$connection);
        $result = mysqli_query(self::$connection, "SELECT * FROM User WHERE UserID = $insertedId");
        
        /* 
            mysqli_fetch_assoc($result): Fetches a result row as an associative array from the result set obtained by executing a query 
            -> Allows you to access each item of the array using $assocArr['fieldName']
        */
        $insertedRow = mysqli_fetch_assoc($result);

        /* asserEquals(A, B): if A is equal to B */
        $this->assertEquals($username, $insertedRow['Username']);
        $this->assertEquals($email, $insertedRow['Email']);

        mysqli_stmt_close($stmt);
    }

    public static function tearDownAfterClass(): void
    {
        // Rollback transaction to avoid persisting test data
        mysqli_rollback(self::$connection);
        mysqli_close(self::$connection);
    }
}

?>
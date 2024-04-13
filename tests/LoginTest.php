<?php
use PHPUnit\Framework\TestCase;

require_once "php/loginAction.php";

class LoginTest extends TestCase
{
    protected $connection;

    protected function setUp(): void {

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
    }

    // Test correct login credentials
    public function testCorrectLoginCredentials()
    {
        // Assuming we have a valid user in the database
        $_POST['username'] = "john_doe";
        $_POST['password'] = "John123123123";

        $_SESSION['username'] = $_POST['username'];

        $errors = isEmptyLogin($_POST['username'], $_POST['password']);

        $this->assertEmpty($errors);
    
    }

    
    protected function tearDown(): void {
        mysqli_close($this->connection);
    }
}

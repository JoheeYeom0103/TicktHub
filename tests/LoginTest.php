<?php
use PHPUnit\Framework\TestCase;

require_once "php/adminAction.php";

class LoginTest extends TestCase
{
    protected static $connection;

    public static function setUpBeforeClass(): void
    {
        // Establish database connection before running tests
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $dbname = getenv('DB_DATABASE');

        self::$connection = new mysqli($host, $user, $pass, $dbname);

        if (self::$connection->connect_error) {
            die("Connection failed: " . self::$connection->connect_error);
        }
    }

    public static function tearDownAfterClass(): void
    {
        // Close database connection after running tests
        if (self::$connection) {
            self::$connection->close();
        }
    }

    public function testLoginAction()
    {
        $this->assertNotNull(self::$connection, "Database connection should not be null");

        // Mock POST data
        $_POST['username'] = "testuser";
        $_POST['password'] = "testpassword";

        // Call the loginAction function
        ob_start();
        loginAction(self::$connection);
        $output = ob_get_clean();

        // Assert that the output is not empty
        $this->assertNotEmpty($output, "Login action should produce output");

        // Assert that session variables are set correctly upon successful login (you can customize this based on your implementation)
        $this->assertArrayHasKey('username', $_SESSION, "Session username should be set upon successful login");
    }
}
?>

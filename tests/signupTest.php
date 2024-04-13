<?php

use PHPUnit\Framework\TestCase;

// require("dbConnect.php");
require_once("signup.php");

class SignupTest extends PHPUnit_Framework_TestCase
{
    // Test valid signup
    public function testValidSignup()
    {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME'); 
        $pass = getenv('DB_PASSWORD'); 
        $dbname = getenv('DB_DATABASE');

        // Create a mysqli connection
        $connection = new mysqli($host, $user, $pass, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $_POST['username'] = 'testuser';
        $_POST['email'] = 'test@example.com';
        $_POST['password'] = 'password';

        $result = signup();

        $this->assertTrue($result);

        ob_start();
        signup($connection);
        $output = ob_get_clean();

        // Assert not empty
        $this->assertNotEmpty($output);
    }

    // Test signup with missing username
    public function testSignupMissingUsername()
    {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME'); 
        $pass = getenv('DB_PASSWORD'); 
        $dbname = getenv('DB_DATABASE');

        // Create a mysqli connection
        $connection = new mysqli($host, $user, $pass, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }


        $_POST['email'] = 'test@example.com';
        $_POST['password'] = 'password';

        $result = signup();

        $this->assertFalse($result);
        ob_start();
        signup($connection);
        $output = ob_get_clean();

        // Assert not empty
        $this->assertNotEmpty($output);
    }

    // Test signup with invalid email
    public function testSignupInvalidEmail()
    {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME'); 
        $pass = getenv('DB_PASSWORD'); 
        $dbname = getenv('DB_DATABASE');

        // Create a mysqli connection
        $connection = new mysqli($host, $user, $pass, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $_POST['username'] = 'testuser';
        $_POST['email'] = 'invalidemail';
        $_POST['password'] = 'password';

        $result = signup();

        $this->assertFalse($result);

        ob_start();
        signup($connection);
        $output = ob_get_clean();

        // Assert not empty
        $this->assertNotEmpty($output);
    }

}
?>

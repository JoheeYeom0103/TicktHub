<?php

use PHPUnit\Framework\TestCase;

require("dbConnect.php");
require_once("login.php");

class loginTest extends TestCase
{
    public function testLogin()
    {

        // get database connection parameters from environment variables
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $dbname = getenv('DB_DATABASE');

        // create a mysqli connection
        $connection = new mysqli($host, $user, $pass, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // call the displayUsers function within the mysqli connection
        ob_start();
        displayUsers($connection);
        $output = ob_get_clean();

        // assertions on the output can be added here 
        $this->assertNotEmpty($output); // example assertion 
        
    } // end of testLogin method



    public function testLoginAction()
    {
        // get database connection parameters from environment variables
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $dbname = getenv('DB_DATABASE');

        // create a mysqli connection
        $connection = new mysqli($host, $user, $pass, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        try{
        // call the loginAction function within the mysqli connection
        ob_start();
        loginAction($connection);
        $output = ob_get_clean();

        // assertions on the output can be added here 
        $this->assertNotEmpty($output); // example assertion 

        } catch (Exception $e) {
            $this->fail("An exception was thrown: " . $e->getMessage());
        }
        
    } // end of testLoginAction method

    public function testLogoutAction()
    {
        // get database connection parameters from environment variables
        $host = getenv('DB_HOST');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $dbname = getenv('DB_DATABASE');

        // create a mysqli connection
        $connection = new mysqli($host, $user, $pass, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        try{
        // call the signupAction function within the mysqli connection
        ob_start();
        logoutAction($connection);
        $output = ob_get_clean();

        // assertions on the output can be added here 
        $this->assertNotEmpty($output); // example assertion 

        } catch (Exception $e) {
            $this->fail("An exception was thrown: " . $e->getMessage());
        }
        
    } // end of testLogoutAction method

} // end of loginTest class
?>

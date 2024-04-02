<?php
require_once "transaction.php";
require_once "browseTicketsResults.php";
class transactiontest extends \PHPUnit\Framework\TestCase {
    public function testTransaction() {
        
        $host = "localhost";
        $database = "cosc360";
        $user = "83066985";
        $db_password = "83066985";

        // Create connection
        $connection = mysqli_connect($host, $user, $db_password, $database);

        $array = array(1,2);

        $quantity = array(1 => 2, 2 => 3);

        $result = insertOrder($connection, 5, 3, $array, $quantity);
        $this->assertNull($result);
        mysqli_close($connection);
    }

    public function testBrowseTickets() {
        $host = "localhost";
        $database = "cosc360";
        $user = "83066985";
        $db_password = "83066985";

        // Create connection
        $connection = mysqli_connect($host, $user, $db_password, $database);

        $result = browseTickets($connection, "music");
        $this->assertNotNull($result);
    }
}
<?php
//require_once "../php/transaction.php";
require_once "browseTicketsResults.php";
class transactiontest extends \PHPUnit\Framework\TestCase {
    public function testTransaction() {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWD');
        $dbname = getenv('DB_DBNAME');

        // Create connection
        $connection = mysqli_connect($host, $user, $pass, $dbname);

        $array = [];

        $quantity = [];

        $result = transaction($connection, 1, 4, "Bank Transfer", $array, $quantity);
        $this->assertNull($result);
        mysqli_close($connection);
    }

    public function testBrowseTickets() {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWD');
        $dbname = getenv('DB_DBNAME');

        // Create connection
        $connection = mysqli_connect($host, $user, $pass, $dbname);

        $result = browseTickets($connection, 1, 4, );
        $this->assertNotNull($result);
    }
}
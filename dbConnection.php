<?php
    // Connection information
    $host = "localhost";
    $database = "tickethub";
    $user = "joy";
    $db_password = "joy5767";

    // Create connection
    $connection = mysqli_connect($host, $user, $db_password, $database);

    // Error message
    $error = mysqli_connect_error();

    // If connection is not successful (If any error message exists)
    if ($error != null) {
        $error_message = "Connection failed: " . mysqli_connect_error();
        exit("<p>$error_message</p>");
    }
?>
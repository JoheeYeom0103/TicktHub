<?php
require_once("dbConnect.php");
session_start();

// Retrieve username from session or set a default value
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    // Fetch SellerID based on the username
    $stmt = $connection->prepare("SELECT UserID FROM user JOIN seller ON user.UserID = seller.SellerID WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sellerID = $row["UserID"];
    } else {
        // Handle the case when the username is not found
        echo "Username not found.";
        exit();
    }

    $stmt->close();
} else {
    // Set a default SellerID if the username is not set
    $sellerID = 1; // You may adjust this value as needed
}

if (isset($_SESSION["AdminID"])) {
    $adminID = $_SESSION["AdminID"];
} else {
    // Set a default AdminID
    $adminID = 4; // You may adjust this value as needed
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST["eventName"];
    $location = $_POST["location"];
    $dateTime = $_POST["dateTime"];
    $quantity = $_POST["quantity"];
    $cost = $_POST["cost"];
    $description = $_POST["description"];

    // Prepare and execute the SQL statements
    $stmt = $connection->prepare("INSERT INTO Event (AdminID, Status, EventName, Location, SellerID) VALUES (?, ?, ?, ?, ?)");
    $status = 'Pending'; // Set the status to "Pending"
    $stmt->bind_param("isssi", $adminID, $status, $eventName, $location, $sellerID);

    if ($stmt->execute()) {
        $eventID = $connection->insert_id; // Use connection object to get insert_id

        $stmt2 = $connection->prepare("INSERT INTO TicketInfo (SellerID, EventID, TicketName, TicketDescription, Price) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("iissd", $sellerID, $eventID, $eventName, $description, $cost);

        if ($stmt2->execute()) {
            // echo "Event created successfully!";
            header("Location: ../salesManageEvents.php");
        } else {
            echo "Error creating ticket info: " . $stmt2->error;
        }

        $stmt2->close();
    } else {
        echo "Error creating event: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Invalid request method.";
}

$connection->close();
?>

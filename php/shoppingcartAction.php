<?php
// shoppingcartAction.php

// Include database connection
include("dbConnect.php");

// Check if the POST request contains the necessary data
if(isset($_POST['ticketID']) && isset($_POST['quantity'])) {
    // Sanitize input data
    $ticketID = $_POST['ticketID'];
    $quantity = $_POST['quantity'];

    // Update the quantity of the item in the database
    $sql = "UPDATE Cart SET Quantity = ? WHERE TicketID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantity, $ticketID);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "Quantity updated successfully.";
    } else {
        echo "Error updating quantity: " . $connection->error;
    }

    // Close prepared statement
    $stmt->close();
}

// Check if the POST request contains the ticketID for item deletion
if(isset($_POST['ticketID']) && isset($_POST['action']) && $_POST['action'] === 'delete') {
    // Sanitize input data
    $ticketID = $_POST['ticketID'];

    // Delete the item from the database
    $sql = "DELETE FROM Cart WHERE TicketID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ticketID);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Item deleted successfully.";
    } else {
        echo "Error deleting item: " . $connection->error;
    }

    // Close prepared statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>

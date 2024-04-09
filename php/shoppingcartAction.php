<?php
require_once("dbConnectM.php");

function updateQuantity($ticketID, $quantity) {
    global $conn;

    $sql = "UPDATE Cart SET Quantity = ? WHERE TicketID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantity, $ticketID);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}

function deleteItem($ticketID) {
    global $conn;

    $sql = "DELETE FROM Cart WHERE TicketID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ticketID);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}

if(isset($_POST['ticketID']) && isset($_POST['quantity'])) {
    $ticketID = $_POST['ticketID'];
    $quantity = $_POST['quantity'];

    $success = updateQuantity($ticketID, $quantity);
    if ($success) {
        echo "Quantity updated successfully.";
    } else {
        echo "Error updating quantity: " . $conn->error;
    }
}

if(isset($_POST['ticketID']) && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $ticketID = $_POST['ticketID'];

    $success = deleteItem($ticketID);
    if ($success) {
        echo "Item deleted successfully.";
    } else {
        echo "Error deleting item: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

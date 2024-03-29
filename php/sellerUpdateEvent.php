<?php
include("dbConnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validatedEventData = validateUpdateEvent($_POST);

    if (!empty($validatedEventData["errors"])) {
        echo"<p>Errors </p>";
    } else {
        // Update event, ticketinfo, and ticketinventory tables
        $updateEvent = updateEvent($validatedEventData["data"]);
        $updateTicketInfo = updateTicketInfo($validatedEventData["data"]);
        $updateTicketInventory = updateTicketInventory($validatedEventData["data"]);

        if ($updateEvent && $updateTicketInfo && $updateTicketInventory) {
            // Redirect to a success page or display a success message
            header("Location: ../salesManageEvents.php");
            exit;
        } else {
            // Handle database update errors
        }
    }

    // Close the database connection
    mysqli_close($connection);
}

function updateEvent($data) {
    global $connection;
    $eventSql = "UPDATE event 
                SET EventName=?, Location=?, DateTime=? 
                WHERE EventID=?";
    $stmt = mysqli_prepare($connection, $eventSql);
    mysqli_stmt_bind_param($stmt, 'sssi', $data['eventName'], $data['location'], $data['dateTime'], $_POST['eventID']);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function updateTicketInfo($data) {
    global $connection;
    $ticketInfoSql = "UPDATE ticketinfo
                    SET price=?
                    WHERE EventID=?";
    $stmt = mysqli_prepare($connection, $ticketInfoSql);
    mysqli_stmt_bind_param($stmt, 'di', $data['price'], $_POST['eventID']);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function updateTicketInventory($data) {
    global $connection;
    $ticketInventorySql = "UPDATE ticketinventory
                            SET TicketQty=?
                            WHERE TicketId =?";
    $stmt = mysqli_prepare($connection, $ticketInventorySql);
    mysqli_stmt_bind_param($stmt, 'ii', $data['quantity'], $data['ticketID']);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function validateUpdateEvent($eventData) {
    $errors = [];
    $validatedData = [];

    // Validate input from the user in the editEvent page
    if (empty($eventData['eventName'])) {
        $errors['eventName'] = "Event Name is required.";
    }

    if (empty($eventData["location"])) {
        $errors["location"] = "Location Name is required.";
    }

    if (empty($eventData["dateTime"])) {
        $errors["dateTime"] = "Date and Time are required.";
    }

    if (empty($eventData["quantity"])) {
        $errors["quantity"] = "Quantity is required";
    }
    
    if ($eventData["quantity"] !== "" && (!is_numeric($eventData["quantity"]) || intval($eventData["quantity"]) != $eventData["quantity"])) {
        $errors["quantity"] = "Quantity must be a whole number.";
    }

    if (empty($eventData["price"])) {
        $errors["price"] = "Price is required";
    }

    if ($eventData["price"] !== "" && (!is_numeric($eventData["price"]))) {
        $errors["price"] = "Price must be a number.";
    }

    // Fetch the ticketID associated with the eventID
    $ticketId = getTicketId($eventData["eventID"]);
    if (!$ticketId) {
        $errors["ticketID"] = "Ticket ID not found.";
    }

    // If there are errors, return them
    if (!empty($errors)) {
        return ["errors" => $errors];
    }

    // If all validation passes, return the validated data
    return ["data" => [
        "eventName" => $eventData['eventName'],
        "location" => $eventData['location'],
        "dateTime" => $eventData['dateTime'],
        "quantity" => $eventData['quantity'],
        "price" => $eventData['price'],
        "ticketID" => $ticketId
    ]];
}

function getTicketId($eventId) {
    global $connection;
    $ticketIdSql = "SELECT TicketId FROM ticketinfo WHERE EventId=?";
    $stmt = mysqli_prepare($connection, $ticketIdSql);
    mysqli_stmt_bind_param($stmt, 'i', $eventId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $ticketIdRow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return ($ticketIdRow) ? $ticketIdRow["TicketId"] : null;
}


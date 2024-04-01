<?php
    include("dbConnect.php");

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the event ID from the form
        $eventID = $_POST['eventID'];

        // Perform any necessary checks or validation here

        // Delete the event from the database
        $sql = "DELETE FROM event WHERE EventID = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $eventID);
        mysqli_stmt_execute($stmt);

        // Redirect with success message
        header('Location: ../salesManageEvents.php?delete=success');    
    } else {
        // Handle the case where the form was not submitted
        echo "<p>An Error Occurred Deleting Your Event</p>";
    }



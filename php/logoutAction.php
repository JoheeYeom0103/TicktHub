<?php
if (isset($_POST["logout"])) {
    // Unset individual session variables.
    unset($_SESSION['username']);
    // Destroy the session.
    session_destroy();
    // Redirect to the login page after signing out.
    header("Location: ../login.php");
    exit();
}


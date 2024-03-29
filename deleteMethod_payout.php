<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("dbConnection.php");

    if (isset($_POST["delete"])) {
        if(isset($_POST["bankId"])) {
            $BankId = $_POST["bankId"];
            $deleteSql = "DELETE FROM BankTransfer WHERE BankId = ?";
        } elseif(isset($_POST["cardId"])) {
            $CardId = $_POST["cardId"];
            $deleteSql = "DELETE FROM CreditCard WHERE CardId = ?";
        } else {
            echo "Missing ID for delete operation.";
            exit();
        }

        $stmt = mysqli_prepare($connection, $deleteSql);
        if($stmt) {
            if(isset($BankId)) {
                mysqli_stmt_bind_param($stmt, "i", $BankId);
            } elseif(isset($CardId)) {
                mysqli_stmt_bind_param($stmt, "i", $CardId);
            }
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Redirect back to the payment info page after deleting the record
            header('Location: payoutinfo.php');
            exit();
        } else {
            echo "Failed to prepare delete statement.";
            exit();
        }
    } else {
        echo "Delete button not set.";
        exit();
    }
} else {
    echo "Invalid request method.";
    exit();
}
?>

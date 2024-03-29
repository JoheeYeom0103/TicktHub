<?php
echo "alert('working!')";
error_reporting(E_ALL);
ini_set('display_errors', 1);

 // Get UserID from session or wherever it's stored
 session_start();
 $userID = isset($_SESSION['userId']) ? $_SESSION['userId'] : 1; 

// Ensure that the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include your database connection file
    include("dbConnection.php");

    // Check if the required fields are set and not empty
    if (isset($_POST["paymentType"]) && !empty($_POST["paymentType"])) {
        // Assign the payment type value from the form
        $paymentType = $_POST["paymentType"];

        // Check the payment type and insert data accordingly
        switch ($paymentType) {
            case "credit-card":
                // Assuming form field names for credit card
                $cardNumber = $_POST["CardNumber"];
                // Assuming the date is coming from a form field named "ExpirationDate"
                $expiryDate = $_POST["ExpirationDate"];
                // Format the date as 'YYYY-MM-DD'
                $expiryDateFormatted = date('Y-m-d', strtotime($expiryDate));

                $cardHolderName = $_POST["CardHolderName"];
                $cvc = $_POST["CVC"];

                global $userID; // get access to global variable, otherwise insert null

                // Prepare the SQL statement for inserting into CreditCard table
                $sql = "INSERT INTO CreditCard (UserID, CardNumber, ExpiryDate, CardHolderName, CVC)
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($connection, $sql);

                // Bind parameters and execute the statement
                mysqli_stmt_bind_param($stmt, "issss", $userID, $cardNumber, $expiryDate, $cardHolderName, $cvc);
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('New record inserted successfully!');</script>";
                    header('Location: paymentinfo.php');
                } else {
                    // Statement execution failed
                    echo "Error: " . mysqli_stmt_error($stmt);
                }
                // Close the statement
                mysqli_stmt_close($stmt);
                break;

            case "bank-transfer":
                // Assuming form field names for bank transfer
                $bankName = $_POST["BankName"];
                $accountHolderName = $_POST["AccountHolderName"];
                $accountNumber = $_POST["AccountNumber"];

                global $userID; // get access to global variable, otherwise insert null

                // Prepare the SQL statement for inserting into BankTransfer table
                $sql = "INSERT INTO BankTransfer (UserID, BankName, AccountHolderName, AccountNumber)
                        VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($connection, $sql);

                // Bind parameters and execute the statement
                mysqli_stmt_bind_param($stmt, "isss", $userID, $bankName, $accountHolderName, $accountNumber);
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('New record inserted successfully!');</script>";
                    header('Location: paymentinfo.php');
                } else {
                    // Statement execution failed
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

                // Close the statement
                mysqli_stmt_close($stmt);
                break;

            default:
                // Handle unsupported payment types
                echo "Unsupported payment type.";
                break;
        }

        // Close the database connection
        mysqli_close($connection);
    } else {
        // Handle missing payment type
        echo "Payment type is missing.";
    }
} else {
    // Handle non-POST requests
    echo "Invalid request method.";
}
?>

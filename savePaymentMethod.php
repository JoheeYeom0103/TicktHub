<?php
session_start();
$UserId = isset($_SESSION["UserId"]) ? $_SESSION["UserId"] : 1; 

include("dbConnection.php");

// Get payment method type and input values from POST request
$paymentType = $_POST['paymentType'];
$bankName = $_POST['Bank Name'];
$accountHolderName = $_POST['Account Holder Name'];
$accountNumber = $_POST['Account Number'];

if ($paymentType === 'bank-transfer') {
    // Insert data into BankTransfer table
    $BankSql = "INSERT INTO BankTransfer (BankName, AccountHolderName, AccountNumber) VALUES (?, ?, ?)";
    $BankPstmt = mysqli_prepare($connection, $BankSql);
    
    if ($BankPstmt) {
        $setDefault = false; // Change this value as needed
        
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($BankPstmt, "sss", $setDefault, $bankName, $accountHolderName, $accountNumber);
        
        // Execute the prepared statement
        mysqli_stmt_execute($BankPstmt);
        
        // Check if data is inserted successfully
        if (mysqli_stmt_affected_rows($BankPstmt) > 0) {
            echo "Bank transfer method added successfully";
        } else {
            echo "Error: Failed to add bank transfer method";
        }
        
        // Close statement
        mysqli_stmt_close($BankPstmt);
    }
} elseif ($paymentType === 'credit-card') {
    // Insert data into CreditCard table
    // Add your code for credit card insertion here
    echo "Credit card method added successfully"; // Example response
} else {
    echo "Error: Invalid payment type";
}

// Close database connection
mysqli_close($connection);
?>

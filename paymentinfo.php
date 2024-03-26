<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$UserID = 1; 

include("dbConnection.php");

$BankSql = "SELECT BankID, BankName, AccountHolderName, AccountNumber 
            FROM BankTransfer 
            JOIN Buyer ON BankTransfer.UserID = Buyer.BuyerID
            WHERE BankTransfer.UserID = ?";
$BankPstmt = mysqli_prepare($connection, $BankSql);

if($BankPstmt) {
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($BankPstmt, "s", $UserID);

    // Execute the prepared statement
    mysqli_stmt_execute($BankPstmt);

    // Bind result variables
    mysqli_stmt_bind_result($BankPstmt, $BankID, $BankName, $AccountHolderName, $AccountNumber); 

    // Fetch bank transfer details
    $bankTransfers = [];
    while (mysqli_stmt_fetch($BankPstmt)) {
        $bankTransfers[] = [
            'BankID' => $BankID,
            'BankName' => $BankName,
            'AccountHolderName' => $AccountHolderName,
            'AccountNumber' => $AccountNumber
        ];
    }

    // Close statement
    mysqli_stmt_close($BankPstmt);
}

$CreditSql = "SELECT CardID, CardNumber, ExpiryDate, CardHolderName, CVC 
              FROM CreditCard 
              JOIN Buyer ON CreditCard.UserID = Buyer.BuyerID
              WHERE CreditCard.UserID = ?";
$CreditPstmt = mysqli_prepare($connection, $CreditSql);

if($CreditPstmt) {
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($CreditPstmt, "s", $UserID);

    // Execute the prepared statement
    mysqli_stmt_execute($CreditPstmt);

    // Bind result variables
    mysqli_stmt_bind_result($CreditPstmt, $CardID, $CardNumber, $ExpiryDate, $CardHolderName, $CVC); 

    // Fetch credit card details
    $creditCards = [];
    while (mysqli_stmt_fetch($CreditPstmt)) {
        $creditCards[] = [
            'CardID' => $CardID,
            'CardNumber' => $CardNumber,
            'ExpiryDate' => $ExpiryDate,
            'CardHolderName' => $CardHolderName,
            'CVC' => $CVC
        ];
    }

    // Close statement
    mysqli_stmt_close($CreditPstmt);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer's Payment Page</title>
    <!-- include css with <link rel="stylesheet" href="filepath.css"> -->
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/leftnav.css">
    <link rel="stylesheet" href="css/paymentInfo.css">
    <!-- include css with <script src="filepath.js">  -->
    <script src="script/paymentInfo.js"></script>
</head>
<body>

<header>
    <h1>TicketHub</h1>
    <ul>
        <li><a href="signup.html">Login/Sign Up!</a></li>
        <li><a href="shoppingcart.html">View Cart</a></li>
    </ul>
</header>

<div id="container">
    <!-- Left side navigator -->
    <nav id="left-nav">
        <ul>
            <li><a href="buyer_personalinfo.html">Personal Info</a></li>
            <li><a href="#">Payment Info</a></li>
            <li><a href="mytickts.html">My Tickets</a></li>
        </ul>
    </nav>

    <!-- Main content -->
    <div id="main-content">
        <div id="payment-details">
            <h2 class="payment-heading">Payment Information</h2>
            <div class="payment-method-container bank-transfer-method-container">
                <h2>Bank Transfer</h2>
                <div class="payment-info">
                <?php foreach ($bankTransfers as $bankTransfer): ?>
                    <form method="post" action="deleteMethod.php">
                        <input type="hidden" name="bankId" value="<?php echo $bankTransfer['BankID']; ?>">
                        <table class="payment-table">
                            <tr>
                                <th>Bank Name</th>
                                <td><?php echo $bankTransfer['BankName']; ?></td>
                            </tr>
                            <tr>
                                <th>Account Holder Name</th>
                                <td><?php echo $bankTransfer['AccountHolderName']; ?></td>
                            </tr>
                            <tr>
                                <th>Account Number</th>
                                <td><?php echo $bankTransfer['AccountNumber']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <!-- Delete and Edit buttons with consistent styling -->
                                    <input type="submit" name="delete" class="delete-button" value="Delete">
                                    <!-- <input type="submit" name="edit" class="edit-button" value="Edit"> -->
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br/>
                <?php endforeach; ?>
                </div>
                <!-- Add New Method button with the same styling -->
                <button class="add-method-button">Add New Method</button>
            </div>

            <div class="payment-method-container credit-card-method-container">
                <h2>Credit Card</h2>
                <div class="payment-info">
                <?php foreach ($creditCards as $creditCard): ?>
                    <form method="post" action="deleteMethod.php">
                        <input type="hidden" name="cardId" value="<?php echo $creditCard['CardID']; ?>">
                        <table class="payment-table">
                            <tr>
                                <th>Card Number</th>
                                <td><?php echo $creditCard['CardNumber']; ?></td>
                            </tr>
                            <tr>
                                <th>Expiration Date</th>
                                <td><?php echo $creditCard['ExpiryDate']; ?></td>
                            </tr>
                            <tr>
                                <th>Card Holder Name</th>
                                <td><?php echo $creditCard['CardHolderName']; ?></td>
                            </tr>
                            <tr>
                                <th>Security Code (CVC)</th>
                                <td><?php echo $creditCard['CVC']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <!-- Delete and Edit buttons with consistent styling -->
                                    <input type="submit" name="delete" class="delete-button" value="Delete">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br/>
                <?php endforeach; ?>
                </div>
                <!-- Add New Method button with the same styling -->
            <button class="add-method-button">Add New Method</button>
            </div>

            <div class="payment-method-container paypal-method-container">
                <h2>PayPal</h2>
                <div class="payment-info">
                    <img src="images/paypal.png" alt="PayPal Logo" id="paypal-logo">
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>

</body>
</html>


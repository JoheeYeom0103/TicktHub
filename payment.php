<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include("php/dbConnect.php");


    session_start();

    $username = $_SESSION["username"];
    $sql1 = "SELECT userID FROM user WHERE username = ?";
    $stmt = $connection->prepare($sql1);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $UserID = $result->fetch_assoc()['userID'];


    //$UserID = isset($_SESSION['userId']) ? $_SESSION['userId'] : 1;
    $TotalCost = isset($_GET['TotalCost']) ? $_GET['TotalCost'] : 1;


    // Getting BankTransfer data from DB
    $BankSql = "SELECT BankID, BankName, AccountHolderName, AccountNumber 
                FROM BankTransfer 
                JOIN Buyer ON BankTransfer.UserID = Buyer.BuyerID
                WHERE BankTransfer.UserID = ?";
    $BankPstmt = mysqli_prepare($connection, $BankSql);

    if($BankPstmt) {

        mysqli_stmt_bind_param($BankPstmt, "s", $UserID);

        mysqli_stmt_execute($BankPstmt);

        mysqli_stmt_bind_result($BankPstmt, $BankID, $BankName, $AccountHolderName, $AccountNumber); 

        $bankTransfers = [];
        while (mysqli_stmt_fetch($BankPstmt)) {
            $bankTransfers[] = [
                'BankID' => $BankID,
                'BankName' => $BankName,
                'AccountHolderName' => $AccountHolderName,
                'AccountNumber' => $AccountNumber
            ];
        }

        mysqli_stmt_close($BankPstmt);
    }

    // Getting CreditCard data from DB
    $CreditSql = "SELECT CardID, CardNumber, ExpiryDate, CardHolderName, CVC 
                FROM CreditCard 
                JOIN Buyer ON CreditCard.UserID = Buyer.BuyerID
                WHERE CreditCard.UserID = ?";
    $CreditPstmt = mysqli_prepare($connection, $CreditSql);

    if($CreditPstmt) {

        mysqli_stmt_bind_param($CreditPstmt, "s", $UserID);

        mysqli_stmt_execute($CreditPstmt);

        mysqli_stmt_bind_result($CreditPstmt, $CardID, $CardNumber, $ExpiryDate, $CardHolderName, $CVC); 

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
        mysqli_stmt_close($CreditPstmt);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/payment.css">
    <script>
        // Script to make sure only one check box can be checked
        // Every time a new check box is chcekd, check if it is the previously checked box
        // If the currently checked box is not the previously checked box, uncheck the previous one   
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    document.querySelectorAll('input[type="checkbox"]').forEach(function(otherCheckbox) {
                        if (otherCheckbox !== checkbox) {
                            otherCheckbox.checked = false;
                        }
                    });
                }
            });
        });

        function validateForm() {
            
            var radioButtons = document.querySelectorAll('input[name="saved-payment-method"]');
            var isChecked = false;

            // Loop through radio buttons to check if any are checked
            for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    isChecked = true;
                    break;
                }
            }

            // If no radio button is checked, alert the user and prevent form submission
            if (!isChecked) {
                alert("Please select a payment method.");
                return false; // Prevent form submission
            }

            return true;
        }
    </script>
</head>
<body>
    <header>
        <h1>TicketHub</h1>
        <ul>
            <?php include("php/showlinks.php");?>
        </ul>
    </header>

    <form method="post" action="php/transaction.php" onsubmit="return validateForm()">
    <div id="container">
        <!-- Bank Transfer Information -->
        <div class="payment-method-container">
            <h2>Bank Transfer</h2>
            <div class="payment-info">
                <?php foreach ($bankTransfers as $bankTransfer): ?>
                    <!-- <form method="post" action="deleteMethod.php"> -->
                        <table class="payment-table">
                        <tr>
                            <td colspan="2" class="checkbox-container"> 
                                <input type="radio" name="saved-payment-method" value="Bank Transfer">
                                Pay with this method
                            </td>
                        </tr>
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
                        </table>
                    <!-- </form> -->
                    <br/>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Credit Card Information -->
        <div class="payment-method-container">
            <h2>Credit Card</h2>
            <div class="payment-info">
                <?php foreach ($creditCards as $creditCard): ?>
                    <!-- <form method="post" action="deleteMethod.php"> -->
                        <table class="payment-table">
                            <tr>
                                <td colspan="2" class="checkbox-container"> 
                                    <input type="radio" name="saved-payment-method" value="Credit Card">
                                    Pay with this method
                                </td>
                            </tr>
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
                        </table>
                    <!-- </form> -->
                    <br/>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Paypal Option -->
        <div class="payment-method-container">
            <h2>PayPal</h2>
            <div class="payment-info">
                <p><input type="radio" id="paypal-checkbox" name="saved-payment-method">Pay with this method<p>
                <img src="images/paypal.png" alt="PayPal Logo" id="paypal-logo">
            </div>
        </div>
    </div>

    <!-- Display Total Amount -->
    <!-- TODO
    - Display total amount from the shopping cart(previous page) 
    - Add form with method, action 
    - Write php script to handle the request(transction) 
    - If request is handled successfully, redirect to the orderConfirmation.html -->
    <h2 id="total">Total: $<?php echo $TotalCost?></h2>
    <div id="proceed-payment">
        <button type="submit" id="submit" name="submit">Proceed Payment</button>
    </div>
    </form>
    <footer>
        <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
    </footer>

</body>
</html>

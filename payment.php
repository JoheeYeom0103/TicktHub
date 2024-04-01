<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/payment.css">
</head>
<body>

<header>
    <h1>TicketHub</h1>
    <ul>
        <!-- The user must have been logged in -->
        <li><a href="buyer_personalinfo.php">User</a></li>
        <li><a href="shoppingcart.php">View Cart</a></li>
    </ul>
</header>

<div id="container">
    <!-- Saved payment method containers -->
    <div class="payment-method-container">
        <div class="checkbox-container">
            <input type="checkbox" checked name="saved-payment-method"> <!-- Enable the checkbox for saved methods -->
        </div>
        <div>
            <h3>Saved Payment Method 1</h3>
            <p>Card Number: XXXX XXXX XXXX 1234</p>
            <p>Card Holder Name: John Doe</p>
            <p>Expiry Date: 12/25</p>
            <p>CVC: XXX</p>
        </div>
    </div>

    <div class="payment-method-container">
        <div class="checkbox-container">
            <input type="checkbox" name="saved-payment-method"> <!-- Enable the checkbox for saved methods -->
        </div>
        <div>
            <h3>Saved Payment Method 2</h3>
            <p>Card Number: XXXX XXXX XXXX 5678</p>
            <p>Card Holder Name: Jane Doe</p>
            <p>Expiry Date: 06/23</p>
            <p>CVC: XXX</p>
        </div>
    </div>

    <!-- Pay with new method section -->
    <div class="payment-method-container" id="new-method-container">
        <div class="checkbox-container">
            <input type="checkbox" id="new-method-checkbox"> <!-- Only one checkbox checked at a time -->
        </div>
        <div id="input-box-container">
            <h3>Pay With New Method</h3>
            <label for="card-number">Card Number:</label>
            <input type="text" id="card-number" class="payment-method-input" placeholder="Enter Card Number">
            <label for="card-holder-name">Card Holder Name:</label>
            <input type="text" id="card-holder-name" class="payment-method-input" placeholder="Enter Card Holder Name">
            <label for="expiry-date">Expiry Date:</label>
            <input type="text" id="expiry-date" class="payment-method-input" placeholder="Enter Expiry Date">
            <label for="cvc">CVC:</label>
            <input type="text" id="cvc" class="payment-method-input" placeholder="Enter CVC">
        </div>
    </div>

    <!-- PayPal container -->
    <div id="paypal-container">
        <input type="checkbox" id="paypal-checkbox" name="saved-payment-method">
        <img src="images/paypal.png" alt="PayPal Logo" id="paypal-logo">
    </div>

    <!-- Proceed payment button -->
    <div id="proceed-payment">
        <button type="button" onclick="proceedPayment()"><a href="orderconfirm.html" style="text-decoration: none; color: white;">Proceed Payment<a></button>
    </div>
</div>

<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>

<script>
    // Function to handle checkbox behavior
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

    // Function to proceed with payment
    function proceedPayment() {
        // Add your payment processing logic here
        alert('Payment processing...');
    }
</script>

</body>
</html>

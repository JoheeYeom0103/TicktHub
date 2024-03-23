<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/shoppingcart.css">
    <script src="script/shoppingcart.js"></script>
</head>
<body>

<header>
    <h1>TicketHub</h1>
    <ul>
        <!-- login? personinfo.html : login.html -->
        <li><a href="login.html">Login/Sign Up</a></li>
        <li><a href="shoppingcart.html">View Cart</a></li>
    </ul>
</header>

<div id="container">
    <!-- Cart items -->
    <div class="cart-item">
        <div class="checkbox-container">
            <input type="checkbox">
        </div>
        <div class="ticket-info">
            <h3>Ticket Name: Concert Ticket</h3>
            <p>Cost: $50 each</p>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="2">
        </div>
        <button class="delete-button">Delete</button>
    </div>

    <div class="cart-item">
        <div class="checkbox-container">
            <input type="checkbox">
        </div>
        <div class="ticket-info">
            <h3>Ticket Name: Sports Event Ticket</h3>
            <p>Cost: $70</p>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1">
        </div>
        <button class="delete-button">Delete</button>
    </div>

    <!-- Total cost -->
    <div class="total-cost">
        <h2>Total Cost: $170</h2>
    </div>

    <!-- Place order buttons -->
    <div id="place-order">
        <button type="button" id="order-selected"><a href="payment.html" style="text-decoration: none; color: white;">Order Selected</a></button>
        <button type="button"><a href="payment.html" style="text-decoration: none; color: white;">Order All</a></button>
    </div>
</div>

<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>

</body>
</html>

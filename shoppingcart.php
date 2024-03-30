<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/shoppingcart.css">
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
   <?php
    include("php/dbConnectM.php");
    $sql = "SELECT * FROM Cart";
    $result = $conn->query($sql);
    $totalCost = 0; // Initialize total cost variable

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<div class="cart-item" id="item-' . $row["TicketID"] . '">';
            echo '<form id="form-' . $row["TicketID"] . '" method="post" action="php/shoppingcartAction.php">';
            echo '<input type="hidden" name="ticketID" value="' . $row["TicketID"] . '">';
            echo '<div class="ticket-info">';
            echo '<h3>Ticket Name: ' . $row["TicketName"] . '</h3>';
            echo '<p>Cost: $' . $row["Price"] . ' each</p>';
            echo '<label for="quantity-' . $row["TicketID"] . '">Quantity:</label>';
            echo '<input type="number" id="quantity-' . $row["TicketID"] . '" name="quantity" min="1" value="' . $row["Quantity"] . '" onchange="updateQuantity(' . $row["TicketID"] . ', event)">';
            echo '</div>';
            echo '<input type="checkbox" name="ticketSelection" class="ticket-selection">'; // Add checkbox for item selection
            echo '<button type="button" onclick="deleteItem(' . $row["TicketID"] . ',' . $row["Price"] . ')" class="delete-button">Delete</button>'; // Change type to button and call deleteItem function
            echo '</form>';
            echo '</div>';

            // Calculate cost for each item and add it to total cost
            $itemCost = $row["Price"] * $row["Quantity"];
            $totalCost += $itemCost;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <!-- Total cost -->
    <div class="total-cost">
        <h2>Total Cost: $<span id="total-cost"><?php echo $totalCost; ?></span></h2>
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

<script>
    function updateQuantity(ticketID, event) {
        var newQuantity = event.target.value; // Get the new quantity from the input field
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/shoppingcartAction.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                updateTotalCost(); // Update the total cost after successful update
            }
        };
        xhr.send("ticketID=" + ticketID + "&quantity=" + newQuantity); // Send ticket ID and new quantity to the server
    }

    function deleteItem(ticketID, price) {
        var confirmation = confirm("Are you sure you want to delete this item?");
        if (confirmation) {
            // Remove item container
            var itemContainer = document.getElementById('item-' + ticketID);
            var quantity = parseInt(itemContainer.querySelector('input[name="quantity"]').value); // Retrieve quantity directly from the item container
            itemContainer.parentNode.removeChild(itemContainer);
            
            // Delete item from database
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "php/shoppingcartAction.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    updateTotalCost(); // Update the total cost after successful deletion
                }
            };
            xhr.send("ticketID=" + ticketID + "&action=delete"); // Send ticket ID and action=delete to the server
        }
    }

    function updateTotalCost() {
        var totalCost = 0;
        var cartItems = document.querySelectorAll('.cart-item');
        
        cartItems.forEach(function(item) {
            var quantity = parseInt(item.querySelector('input[name="quantity"]').value);
            var price = parseFloat(item.querySelector('.ticket-info p').textContent.replace('Cost: $', '').trim());
            var itemCost = quantity * price;
            totalCost += itemCost;
        });

        document.getElementById('total-cost').innerText = totalCost.toFixed(2); // Update total cost in the DOM
    }
</script>

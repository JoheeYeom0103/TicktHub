<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- stylesheets -->
    <link rel="stylesheet" href="css/loginStyling.css">
    <link rel="stylesheet" href="css/headerFooter.css">
    <!-- stylesheets -->

    <!-- Scripts -->
    <script src="script/loginScript.js"></script>
    <!-- Scripts -->

</head>
<body>
    <header>
        <h1><a href="browseTickets.php" style="color: inherit; text-decoration: none;">TicketHub</a></h1>
        <ul>
            <!-- <li><a href="cart.html">View Cart</a></li>  -->
            <li><a href="signup.php">Sign Up</a></li>
            
        </ul>
    </header>
    <div class="loginContainer">
        <h3>Login</h3>
        <form id="loginForm" action="http://www.randyconnolly.com/tests/process.php" method="post">
            <label for="username">Username:</label>
            <input class="username-input" type="text" id="username" name="username">
            <label for="password">Password:</label>
            <input class="password-input" type="password" id="password" name="password">
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account with us? Sign Up!</p>
        <input type="button" value="Sign Up" onclick="window.location.href='signup.php';">
    </div>
<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <!-- stylesheets -->
    <link rel="stylesheet" href="css/signupStyling.css">
    <link rel="stylesheet" href="css/headerFooter.css">
    <!-- stylesheets -->

    <!-- scripts -->
    <script src="script/signupScript.js"></script>
    <!-- scripts -->

</head>
<body>
    <header>
        <h1><a href="browseTickets.php" style="color: inherit; text-decoration: none;">TicketHub</a></h1>
        <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="shoppingcart.php">View Cart</a></li> 
        </ul>
    </header>        
    <div class="signupContainer">
        <h3>Sign Up</h3>
        <form id="signupForm" action="http://www.randyconnolly.com/tests/process.php" method="post">
            <label for="userID">User ID:</label>
            <p id="signupFormHint">Ensure your userID is between 4 and 16 characters</p>
   <!--0--> <input class="username-input" type="text" id="userID" name="userID" >
            
            <label for="firstName">First Name:</label>
            <p id="signupFormHint">Ensure your first name is between 2 and 16 characters</p>
   <!--1--> <input class="firstname-input" type="text" id="firstName" name="firstName" >
            
            <label for="middleName">Middle Name:</label>
            <p id="signupFormHint">Ensure your middle name is between 2 and 16 characters</p>
   <!--2--> <input class="middlename-input" type="text" id="middleName" name="middleName">
            
            <label for="lastName">Last Name:</label>
            <p id="signupFormHint">Ensure your last name is between 2 and 16 characters</p>
   <!--3--> <input class="lastname-input" type="text" id="lastName" name="lastName" >
            
            <label for="email">Email:</label>
            <p id="signupFormHint">Ensure your email is in the form username@domain.com</p>
   <!--4--> <input class="email-input" type="email" id="email" name="email" >
            
            <label for="phone">Phone Number:</label>
            <p id="signupFormHint">Ensure your phone number is in the form XXX-XXX-XXXX</p>
   <!--5--> <input class="phone-input" type="tel" id="phone" name="phone" >
            
            <label for="password">Password:</label>
            <p id="signupFormHint">Ensure your password is between 12 and 14 characters</p>
   <!--6--> <input class="password-input" type="password" id="password" name="password" >
            
            <label for="confirmPassword">Confirm Password:</label>
            <p id="signupFormHint">Ensure your password matches with what you've written above</p>
   <!--7--> <input class="confirm-password-input" type="password" id="confirmPassword" name="confirmPassword" >

            <label for="userType">Sign up as:</label>
            <p id="signupFormHint">Ensure you select a user type</p>
            <div class="userTypeContainer">
                <input type="radio" id="buyer" name="userType" value="buyer" required>
                <label for="buyer">Buyer</label>
                
                <input type="radio" id="seller" name="userType" value="seller" required>
                <label for="seller">Seller</label>
            </div>
            <input type="submit" value="Sign Up">
        </form>
        <p>Already have an account with us? Log in!</p>
        <input type="button" value="Login" onclick="window.location.href='login.php';">
    </div>
    <footer>
        <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
    </footer>
</body>
</html>

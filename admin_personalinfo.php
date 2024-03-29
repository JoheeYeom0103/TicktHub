<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/headerFooter.css">
    <link rel="stylesheet" href="css/leftnav.css">
    <link rel="stylesheet" href="css/personalInfoStyling.css">
    <!-- Stylesheets -->

    <!-- scripts -->
    <script src="script/personalInfoValidation"></script>
    <!-- scripts -->

    <?php 
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username']; 
        }else{
            $username = 'null';
        }
    ?>

</head>
<body>

<header>
    <h1>TicketHub</h1>
    <ul>
        <li><a href="admin_personalinfo.php">Admin @ <?php echo $username?></a></li>
        <!-- <li><a href="shoppingcart.html">View Cart</a></li> -->
    </ul>
</header>

<div id="container">
    <!-- Left side navigator -->
    <nav id="left-nav">
        <ul>
            <li><a href="admin_personalinfo.php">Personal Info</a></li>
            <li><a href="adminDashboard.php">Dashboard</a></li>
        </ul>
    </nav>

    <!-- Main content -->
    <div id="main-content">
        <div id="profile-details">
            <h2 class="profile-heading">Edit Account</h2>
            <form id="editAccountForm" action="/submit_form" method="post" class="user-profile">
                <div id="userPhoto">
                    <label for="userPhoto">Photo</label>
                    <img src="images/usericon-01.svg" alt="User Icon">
                    <!-- If you want to create a button with specific input type, 
                        Crate non-display input element -> Create button with onclick event listener triggered by the input -->
                    <div id="image-btn">
                        <input type="file" id="profileImg" name="profileImg" style="display: none;">
                        <button type="button" onclick="document.getElementById('profileImg').click()">Choose Image</button>
                    </div>
                </div>
    
                <div class="profile-field">
                    <label for="userId">User ID:</label>
                    <input class="username-input" type="text" id="userId" name="userId" placeholder="Enter your user ID">
                </div>
    
                <div id="userNames">
                    <div class="profile-field">
                        <label for="firstName">First Name:</label>
                        <input class="firstname-input" type="text" id="firstName" name="firstName" placeholder="Enter your first name">
                    </div>
    
                    <div class="profile-field">
                        <label for="middleName">Middle Name:</label>
                        <input class="middlename-input" type="text" id="middleName" name="middleName" placeholder="Enter your middle name">
                    </div>
    
                    <div class="profile-field">
                        <label for="lastName">Last Name:</label>
                        <input class="lastname-input" type="text" id="lastName" name="lastName" placeholder="Enter your last name">
                    </div>
                </div>
    
                <div id="userPw">
                    <div class="profile-field">
                        <label for="password">Password:</label>
                        <input class="password-input" type="password" id="password" name="password" placeholder="Enter your password">
                    </div>
    
                    <div class="profile-field">
                        <label for="passwordConfirmation">Password Confirmation:</label>
                        <input class="confirm-password-input" type="password" id="passwordConfirmation" name="passwordConfirmation" placeholder="Confirm your password">
                    </div>
                </div>
    
                <div class="profile-field">
                    <label for="email">Email Address:</label>
                    <input class="email-input" type="email" id="email" name="email" placeholder="Enter your email address">
                </div>
    
                <div class="profile-field">
                    <label for="phoneNumber">Phone Number:</label>
                    <input class="phone-input" type="tel" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number">
                </div>
    
                <div id="buttons">
                    <button id="cancel-button" type="button" class="buttons">Cancel</button>
                    <button type="submit" class="buttons">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
</footer>

</body>
</html>

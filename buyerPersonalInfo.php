<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include("php/dbConnect.php");
    // Initialize old variables
    $old_username = $old_firstname = $old_middlename = $old_lastname = $old_password = $old_email = $old_phonenum = "";

    /******************************* SESSION *******************************/
    session_start();

    $username = isset($_SESSION['username']) ? $_SESSION['username'] : "john_doe";
    $buyerID = null;
    
    $sql = "SELECT * FROM User WHERE Username = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $buyerID = trim($row["UserID"]);
    }
    $old_userId = $buyerID;
    /******************************* SESSION *******************************/

    // Assign the old variables with data stored in the database
    $sql = "SELECT UserName, FirstName, MiddleName, LastName, Password, Email, Phone FROM User WHERE UserId = ?";
    $pstmt = mysqli_prepare($connection, $sql);

    if ($pstmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($pstmt, "i", $old_userId);

        // Execute the prepared statement
        mysqli_stmt_execute($pstmt);

        // Bind result variables
        mysqli_stmt_bind_result($pstmt, $old_username, $old_firstname, $old_middlename, $old_lastname, $old_password, $old_email, $old_phonenum);

        // Fetch values
        mysqli_stmt_fetch($pstmt);

        // Close connection
        mysqli_stmt_close($pstmt);

    }

    // Function to get input value
    function getInputValue($field) {
        global $old_username, $old_firstname, $old_middlename, $old_lastname, $old_password, $old_email, $old_phonenum;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // If the form has been submitted, return the submitted value
            return isset($_POST[$field]) ? $_POST[$field] : '';
        } else {
            // If the form has not been submitted, return previously saved values
            switch ($field) {
                case 'userName':
                    return $old_username;
                case 'firstName':
                    return $old_firstname;
                case 'middleName':
                    return $old_middlename;
                case 'lastName':
                    return $old_lastname;
                case 'password':
                    return $old_password;
                case 'passwordConfirmation':
                    return $old_password;
                case 'email':
                    return $old_email;
                case 'phoneNumber':
                    return $old_phonenum;    
                default:
                    return '';
            }
        }
    }

    include('php/personalInfo_Action.php');
?>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        
            const form = document.getElementById('editAccountForm');
            const formInputs = [
                document.querySelector('#userName-input'),
                document.querySelector('#firstname-input'),
                document.querySelector('#middlename-input'),
                document.querySelector('#lastname-input'),
                document.querySelector('#email-input'),
                document.querySelector('#phone-input'),
                document.querySelector('#password-input'),
                document.querySelector('#confirm-password-input')
            ];

            // constantly update css every time there is a change in the input
            form.addEventListener('input', function(){
                validityCheck();
            });

            // Validation and styling for incorrect fields --> empty or bad form 
            form.addEventListener('submit', function(e) {

                // Prevent form submission if there are errors
                if(validityCheck() >= 1){
                    alert("Please correct highlighted fields");
                    e.preventDefault();
                }else {
                    alert("Change have been successfully saved");
                }

            });

            function validityCheck() {
                
                let errorCount = 0;

                // Check for empty inputs and apply visual indication
                formInputs.forEach(input => {
                    if (input.value.trim() === '') {
                        if(input.id !== 'middlename-input') { // Exclude middleName from validation
                            errorCount++;
                            applyErrorStyles(input);
                        } else {
                            removeErrorStyles(input);
                        }
                    } else {
                        removeErrorStyles(input);
                    }
                });

                // Validate username length
                if(formInputs[0].value.trim().length < 4 || formInputs[0].value.trim().length > 16){
                    errorCount++;
                    applyErrorStyles(formInputs[0]);
                } else {
                    removeErrorStyles(formInputs[0]);
                }

                // Validate password length
                if(formInputs[6].value.trim().length < 12 || formInputs[6].value.trim().length > 14){
                    errorCount++;
                    applyErrorStyles(formInputs[6]);
                } else {
                    removeErrorStyles(formInputs[6]);
                }

                // Validate email format
                if(!validateEmail(formInputs[4].value.trim())){
                    errorCount++;
                    applyErrorStyles(formInputs[4]);
                } else {
                    removeErrorStyles(formInputs[4]);
                }

                // Validate phone number format
                if(!validatePhoneNum(formInputs[5].value.trim())){
                    errorCount++;
                    applyErrorStyles(formInputs[5]);
                } else {
                    removeErrorStyles(formInputs[5]);
                }

                // Validate password confirmation
                if(formInputs[7].value.trim() !== formInputs[6].value.trim()){
                    errorCount++;
                    applyErrorStyles(formInputs[7]);
                } else {
                    removeErrorStyles(formInputs[7]);
                }

                return errorCount;

                // Function to validate email format
                function validateEmail(email){
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailPattern.test(email);
                }

                // Function to validate phone number format
                function validatePhoneNum(phoneNumber){
                    const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
                    return phonePattern.test(phoneNumber);
                }

                // Function to apply error styles to input fields
                function applyErrorStyles(input){
                    input.style.borderWidth = "1px";
                    input.style.borderColor = "#c90e02"; 
                    input.style.backgroundColor = "#e8b0b0";
                }

                // Function to remove error styles from input fields
                function removeErrorStyles(input){
                    input.style.borderWidth = "1px";
                    input.style.borderColor = ""; 
                    input.style.backgroundColor = "";
                }
            }
        });
    </script>
</head>
<body>

<header>
    <h1>TicketHub</h1>
    <ul>
        <!-- The user must have been logged in -->
        <li><a href="browseTickets.php">Home</a></li>
        <li><a href="shoppingcart.php">View Cart</a></li>
    </ul>
</header>

<div id="container">
    <!-- Left side navigator -->
    <nav id="left-nav">
        <ul>
            <li><a href="#">Personal Info</a></li>
            <li><a href="paymentinfo.php">Payment Info</a></li>
            <li><a href="mytickts.php">My Tickets</a></li>
        </ul>
    </nav>

    <!-- Main content -->
    <div id="main-content">
        <div id="profile-details">
            <h2 class="profile-heading">Edit Account</h2>
            <form id="editAccountForm" action="" method="post" class="user-profile">
                <div id="userPhoto">
                    <img src="images/usericon-01.svg" alt="User Icon">
                </div>
    
                <div class="profile-field">
                    <label for="userName">User Name:</label>
                    <input id="userName-input" type="text" name="userName" placeholder="Enter your user name" placeholder="Your user name" value="<?php echo getInputValue('userName'); ?>">
                </div>
    
                <div id="userNames">
                    <div class="profile-field">
                        <label for="firstName">First Name:</label>
                        <input id="firstname-input" type="text"  name="firstName" placeholder="Enter your first name" value="<?php echo getInputValue('firstName'); ?>" >
                    </div>
    
                    <div class="profile-field">
                        <label for="middleName">Middle Name:</label>
                        <input id="middlename-input" type="text" id="middleName" name="middleName" placeholder="Enter your middle name" value="<?php echo getInputValue('middleName'); ?>" >
                    </div>
    
                    <div class="profile-field">
                        <label for="lastName">Last Name:</label>
                        <input id="lastname-input" type="text" name="lastName" placeholder="Enter your last name" value="<?php echo getInputValue('lastName'); ?>" >
                    </div>
                </div>
    
                <div id="userPw">
                    <div class="profile-field">
                        <label for="password">Password:</label>
                        <input id="password-input" type="password" name="password" placeholder="Enter your password" value="<?php echo getInputValue('password'); ?>" >
                    </div>
    
                    <div class="profile-field">
                        <label for="passwordConfirmation">Password Confirmation:</label>
                        <input id="confirm-password-input" type="password" value="<?php echo getInputValue('passwordConfirmation'); ?>">
                    </div>
                </div>
    
                <div class="profile-field">
                    <label for="email">Email Address:</label>
                    <input id="email-input" type="email" id="email" name="email" placeholder="Enter your email address" value="<?php echo getInputValue('email'); ?>">
                </div>
    
                <div class="profile-field">
                    <label for="phoneNumber">Phone Number:</label>
                    <input id="phone-input" type="tel" name="phoneNumber" placeholder="Enter your phone number" value="<?php echo getInputValue('phoneNumber'); ?>">
                </div>
    
                <div id="buttons">
                    <button type="submit" name="cancel" class="buttons">Cancel</button>
                    <button type="submit" name ="submit" class="buttons">Save</button>
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

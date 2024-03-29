<?php 

require ("dbConnectZ.php");

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userID = $_POST['userID']; // this is the username 
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $userType = $_POST['userType'];
    // $username = $firstName . " " . $middleName . " " . $lastName;

    


    $errors = validateSignup($userID, $firstName, $middleName, $lastName, $password, $confirmPassword, $email, $phone, $userType);

    if(empty($errors)) {

        $initSql = "SELECT Username, Email FROM User";
        $results = mysqli_query($connection, $initSql);
        // set up empty array to store user data fetched from the DB
        $userData = array();

        // and fetch results 
        while($row = mysqli_fetch_assoc($results)) {
            $userData[] = array('username' => $row['Username'], 'email' => $row['Email']);
        }

        // variable to check if user exists 
        $userExists = false;
        for($i = 0; $i < count($userData); $i++) {
            if($userData[$i]['username'] === $userID || $userData[$i]['email'] === $email) {
                $userExists = true;
                break;
            } // end of if statement
        } // end of for loop

        if($userExists === true) {
            $errors[] = "<p> User already exists with this user ID, username and/or email </p>";
            $_SESSION['loginErrors'] = $errors;
            header("Location: ../signup.php");
            // exit();
        } else {
            $INSERTSql = "INSERT INTO User (Username, FirstName, MiddleName, LastName, Password, Email, Phone) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($connection, $INSERTSql);

            mysqli_stmt_bind_param($stmt, "sssssss", $userID, $firstName, $middleName, $lastName, $password, $email, $phone);

            mysqli_stmt_execute($stmt);

            // get the last autoincremented user ID that is inserted
            $lastUserID = mysqli_insert_id($connection);
            if($userType === 'seller') {
                $sql = "INSERT INTO Seller (SellerID) VALUES (?)";
                $stmt2 = mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($stmt2, "i", $lastUserID);
                mysqli_stmt_execute($stmt2);

                $_SESSION['username'] = $userID;
                header("Location: ../seller_personalinfo.html");
            } elseif($userType === 'buyer') {
                $sql = "INSERT INTO Buyer (BuyerID) VALUES (?)";
                $stmt3 = mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($stmt3, "i", $lastUserID);
                mysqli_stmt_execute($stmt3);

                $_SESSION['username'] = $userID;
                header("Location: ../buyer_personalinfo.html");
            } // end of else statement

            mysqli_stmt_close($stmt);

        } // end of else statement

    } // end of if statement

    else {
        header("Location: ../signup.php");
    }
} // end of if request POST statement

mysqli_close($connection);


function validateSignup($userID, $firstName, $middleName, $lastName, $password, $confirmPassword, $email, $phone, $userType) {
    $errors = array();

    if(empty($userID)) {
        $errors[] = "Please enter a user ID. This acts as your username!";
    } elseif (strlen($userID) < 4 || strlen($userID) > 16) {
        $errors[] = "User ID must be between 4 and 16 characters long. This acts as your username!";
    }

    if(empty($firstName)) {
        $errors[] = "Please enter a first name";
    } elseif(strlen($firstName) < 2 || strlen($firstName) > 16) {
        $errors[] = "First name must be between 2 and 16 characters long";
    }

    if(empty($middleName)) {
        $errors[] = "Please enter a middle name";
    }elseif(strlen($middleName) < 2 || strlen($middleName) > 16) {
        $errors[] = "Middle name must be between 2 and 16 characters long";
    }

    if(empty($lastName)) {
        $errors[] = "Please enter a last name";
    }elseif(strlen($lastName) < 2 || strlen($lastName) > 16) {
        $errors[] = "Last name must be between 2 and 16 characters long";
    }

    // if(!empty($firstName) && !empty($middleName) && !empty($lastName)) {
    //     $username = $firstName . " " . $middleName . " " . $lastName;
    // } 

    if(empty($password)) {
        $errors[] = "Please enter a password";
    } elseif(strlen($password) < 12 || strlen($password) > 14) {
        $errors[] = "Password must be between 12 and 14 characters long";
    }

    if(empty($confirmPassword)) {
        $errors[] = "Please confirm your password";
    } elseif($password != $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    if(empty($email)) {
        $errors[] = "Please enter an email";
    } elseif (validateEmail($email) == false) {
        $errors[] = "Invalid email format";
    }

    if(empty($phone)) {
        $errors[] = "Please enter a phone number";
    } elseif(strlen($phone) != 12) {
        $errors[] = "Phone number must be 10 digits long, and in the form XXX-XXX-XXXX";
    }

    if(empty($userType)) {
        $errors[] = "Please select a user type";
    }

    $_SESSION['loginErrors'] = $errors;
    return $errors;
    

} // end of validateSignup function


function validateEmail($email) {

    $emailPattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
    return preg_match($emailPattern, $email);

} // end of validateEmail function


   

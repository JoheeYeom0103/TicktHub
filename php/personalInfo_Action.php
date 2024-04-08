<?php
    // Include necessary files
    include("dbConnect.php");

    // Form has been submitted (The user clicked either 'save' or 'cancel')
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // The user clicked saved 
        if (isset($_POST['submit'])) {

            // Initialise $isValid to keep track of validity of every fields
            $isValid = true;
            $new_userName = getInputValue('userName');
            $new_firstName = getInputValue('firstName');
            $new_middleName = getInputValue('middleName');
            $new_lastName = getInputValue('lastName');
            $new_password = getInputValue('password');
            $new_email = getInputValue('email');
            $new_phoneNum = getInputValue('phoneNumber');

            $updateSQL = "UPDATE User SET UserName=?, FirstName=?, MiddleName=?, LastName=?, Email=?, Password=?, PhoneNumber=? WHERE UserId=?";
            $updatePstmt = mysqli_prepare($connection, $updateSQL);

            if ($updatePstmt) {
                mysqli_stmt_bind_param($updatePstmt, "sssssssi", $new_userName, $new_firstName, $new_middleName, $new_lastName, $new_email, $new_password, $new_phoneNum, $old_userId);
                $success = mysqli_stmt_execute($updatePstmt);

                if ($success) {
                    // Save the new data into the old variables
                    $old_username = $new_userName;
                    $old_firstname = $new_firstName;
                    $old_middlename = $new_middleName;
                    $old_lastname = $new_lastName;
                    $hashed_password = md5($new_password);
                    $old_password = $hashed_password;
                    $old_email = $new_email;
                    $old_phonenum = $new_phoneNum;
                    echo "<script>alert('Changes have been successfully saved!'); window.location.href = 'buyerPersonalInfo.php';</script>";
                    exit;
                } else {
                    echo "<script>alert('Failed to save changes')</script>";
                }

                mysqli_stmt_close($updatePstmt);
            }
            
        } elseif (isset($_POST['cancel'])) {
            // Redirect to a page after cancellation
            header('Location: buyerPersonalInfo.php');
            exit; 
        }
    }
?>

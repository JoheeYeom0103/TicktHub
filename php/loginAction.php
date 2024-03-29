<?php 

require ("dbConnectZ.php");

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['username'];
    $password = $_POST['password'];
    

    $errors = isEmptyLogin($userID, $password);

    if(empty($errors)) {
        $sql = "SELECT * FROM User WHERE Username = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $userID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $dbPass = trim($row["Password"]);
            // if($hashedPassword === $dbPass)
            if($password === $dbPass) {

                $_SESSION['userID'] = $userID;
                
                // to check if user is buyer or seller 
                $sqlUserType = "SELECT User.UserID, Buyer.BuyerID, Seller.SellerID 
                FROM User 
                LEFT JOIN Buyer ON User.UserID = Buyer.BuyerID 
                LEFT JOIN Seller ON User.UserID = Seller.SellerID 
                WHERE User.UserID = ?";

                $stmt2 = mysqli_prepare($connection, $sqlUserType);
                mysqli_stmt_bind_param($stmt2, "i", $row['UserID']);
                mysqli_stmt_execute($stmt2);
                $result2 = mysqli_stmt_get_result($stmt2);
                $userTypeRow = mysqli_fetch_assoc($result2);

                if (!($userTypeRow['BuyerID'])) {
                    // The user is a seller
                    
                    header("Location: ../seller_personalinfo.html");
                    exit();
                }
                if (!($userTypeRow['SellerID'])) {
                    // The user is a buyer
                    
                    header("Location: ../buyer_personalinfo.html");
                    exit();
                }
                  
            }
            else {
                $errors[] = "Password is incorrect";
            }
        } else {
            $errors[] = "Username or password is incorrect";
        }

        mysqli_stmt_close($stmt);
    } 

    $_SESSION['loginErrors'] = $errors;

    header("Location: ../login.php");
    exit();

} // end of if request POST  method 

mysqli_close($connection);

function isEmptyLogin($username, $password) {
    $errors = array();

    if(empty($username)) {
        $errors[] = "Username is required";
    }

    if(empty($password)) {
        $errors[] = "Password is required";
    }

    return $errors;
}
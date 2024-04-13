<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "dbConnect.php";
    $userID = $_POST['username'];
    $password = $_POST['password'];

    $errors = isEmptyLogin($userID, $password);

    if (empty($errors)) {
        $sql = "SELECT * FROM User WHERE Username = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $userID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $dbPass = trim($row["Password"]);
            if ($password === $dbPass) {
                $_SESSION['username'] = $userID;

                // Check if the user is an admin
                $sqlAdmin = "SELECT AdminID FROM Admin WHERE AdminID = ?";
                $stmtAdmin = mysqli_prepare($connection, $sqlAdmin);
                mysqli_stmt_bind_param($stmtAdmin, "i", $row['UserID']);
                mysqli_stmt_execute($stmtAdmin);
                $resultAdmin = mysqli_stmt_get_result($stmtAdmin);

                if (mysqli_num_rows($resultAdmin) > 0) {
                    // The user is an admin
                    header("Location: ../adminDashboard.php");
                    exit();
                }

                // Check if the user is a buyer
                $sqlBuyer = "SELECT BuyerID FROM Buyer WHERE BuyerID = ?";
                $stmtBuyer = mysqli_prepare($connection, $sqlBuyer);
                mysqli_stmt_bind_param($stmtBuyer, "i", $row['UserID']);
                mysqli_stmt_execute($stmtBuyer);
                $resultBuyer = mysqli_stmt_get_result($stmtBuyer);

                if (mysqli_num_rows($resultBuyer) > 0) {
                    // The user is a buyer
                    header("Location: ../browseTickets.php");
                    exit();
                } else {
                    // The user is a seller
                    header("Location: ../browseTickets.php");
                    exit();
                }
            } else {
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
}

mysqli_close($connection);

function isEmptyLogin($username, $password) {
    $errors = array();

    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    return $errors;
}

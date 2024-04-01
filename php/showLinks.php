<?php

if (!isset($_SESSION["username"])) { // If user is not logged in
    // Display links for guest users
    echo '<li><a href="login.php">Login/Signup</a></li>';
    echo '<li><a href="shoppingcart.php">View Cart</a></li>';
} else {

    include("dbConnect.php");
    include("logoutAction.php");

    $username = $_SESSION["username"];
    $queryAdmin = "SELECT AdminID FROM admin JOIN user ON admin.AdminID = user.UserID WHERE user.username = '$username'";
    $queryBuyer = "SELECT BuyerID FROM buyer JOIN user ON buyer.BuyerID = user.UserID WHERE user.username = '$username'";
    $querySeller = "SELECT SellerID FROM seller JOIN user ON seller.SellerID = user.UserID WHERE user.username = '$username'";

    $resultAdmin = mysqli_query($connection, $queryAdmin);
    $resultBuyer = mysqli_query($connection, $queryBuyer);
    $resultSeller = mysqli_query($connection, $querySeller);

    $role = "";
    if (mysqli_num_rows($resultAdmin) > 0) {
        $role = "admin";
    } elseif (mysqli_num_rows($resultBuyer) > 0) {
        $role = "buyer";
    } elseif (mysqli_num_rows($resultSeller) > 0) {
        $role = "seller";
    }

    // Display links based on user's role
    if ($role == "buyer") {
        echo '<li><a href="buyerPersonalInfo.php">@' . $username . '</a></li>';
        echo '<li><a href="shoppingcart.php">View Cart</a></li>';
        echo '<li><form action="php/logoutAction.php" method="post"><button class="logoutButton" type="submit" name="logout">Logout</button></form></li>';
    }else if($role == "seller"){
        echo '<li><a href="sellerPersonalInfo.php">@' . $username . '</a></li>';
        echo '<li><a href="shoppingcart.php">View Cart</a></li>';
        echo '<li><form action="php/logoutAction.php" method="post"><button class="logoutButton" type="submit" name="logout">Logout</button></form></li>';
    }else if($role == "admin"){
        echo '<li><a href="adminDashboard.php">@' . $username . '</a></li>';
        echo '<li><form action="php/logoutAction.php" method="post"><button class="logoutButton" type="submit" name="logout">Logout</button></form></li>';
    }
}
?>

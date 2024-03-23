<?php

    function displayUsers(){
        include("dbConnect.php");
        $sql = "SELECT UserID, Username, FirstName, LastName, Email FROM user;";
        $results = mysqli_query($connection, $sql);

        //and fetch requsults
        while ($row = mysqli_fetch_assoc($results))
        {
        $userID = $row['UserID'];
        $username = $row['Username'];
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $email = $row['Email'];

        echo "<tr>
                    <td>" . $userID . "</td>". 
                    "<td>" . $username . "</td>".
                    "<td>" . $firstName . " " . $lastName . "</td>". 
                    "<td>". $email ."</td>".
                "</tr>";
        }

        mysqli_free_result($results);
        mysqli_close($connection);
    }

    function displayAverageSales(){
        include("dbConnect.php");
        // Query the DB to access the average ticket price per month/year
        $sql = "SELECT YEAR(o.OrderDateTime) AS Year, 
                       MONTH(o.OrderDateTime) AS Month,
                       AVG(ti.Price * o.TicketQuantity) AS AverageTicketSales 
                FROM Orders o
                JOIN TicketInfo ti ON o.TicketID = ti.TicketID
                GROUP BY YEAR(o.OrderDateTime), MONTH(o.OrderDateTime);";
        $results = mysqli_query($connection, $sql);
    
        //and fetch results
        while ($row = mysqli_fetch_assoc($results))
        {
            // store results
            $year = $row['Year'];
            $month = $row['Month'];
            $sales = $row['AverageTicketSales'];
    
            // print out the results in a table format for the admin to view
            echo "<tr>
                        <td>" . date('M Y', mktime(0, 0, 0, $month, 1, $year)) . "</td>". 
                        "<td>" . number_format($sales, 2) . "</td>". 
                 "</tr>";
        }
    
        mysqli_free_result($results);
        mysqli_close($connection);
    }
    
    
    function displayUserReqs(){
        include("dbConnect.php");
    
        if(isset($_POST['action'])){
            $eventId = $_POST['eventId'];
            $action = $_POST['action'];
    
            // Update the status based on the action
            $status = ($action === 'approve') ? 'Approved' : 'Rejected';
            $sql = "UPDATE Event SET Status = '$status' WHERE EventID = $eventId";
            mysqli_query($connection, $sql);
        }
    
        $sql = "SELECT s.SellerID, e.EventID, e.EventName, e.Status
                FROM Seller s
                JOIN Event e ON s.SellerID = e.AdminID";
    
        $results = mysqli_query($connection, $sql);
    
        while ($row = mysqli_fetch_assoc($results)){
            echo "<tr>
                    <td>{$row['SellerID']}</td>
                    <td>{$row['EventName']}</td>
                    <td>{$row['Status']}</td>
                    <td>
                        <form method='post'>
                            <input type='hidden' name='eventId' value='{$row['EventID']}'>
                            <input type='submit' name='action' value='Approve'>
                            <input type='submit' name='action' value='Reject'>
                        </form>
                    </td>
                  </tr>";
        }
    
        echo "</table>";
    
        mysqli_free_result($results);
        mysqli_close($connection);
    }
    
    
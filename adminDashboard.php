<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administrator Dashboard</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/adminDashboardStyling.css">
    <link rel="stylesheet" href="css/headerFooter.css">
    <!-- Stylesheets -->

    <!-- Scripts -->
    <script src="script/adminDashboardScript.js"></script>
    <!-- Scripts -->

    <meta content="width=device-width, initial-scale=1" name="viewport" />
</head>
<body>
    <header>
        <h1><a href="browseTickets.html" style="color: inherit; text-decoration: none;">TicketHub</a></h1>
        <ul>
            <li><a href="#">Admin @username</a></li> <!-- UPDATE W/ CORRECT LINK  -->
        </ul>
    </header>
    <div class="adminContainer">
        <h3>Administrator Dashboard</h3>
        <div class="tabs">
            <div class="tab active" onclick="showTab('users')">Users</div>
            <div class="tab" onclick="showTab('sales')">Average Sales</div>
            <div class="tab" onclick="showTab('requests')">User Requests</div>
        </div>
        <div class="tab-content active" id="users">
            <table>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john.doe@example.com</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>jane.smith@example.com</td>
                </tr>
            </table>
        </div>
        <div class="tab-content" id="sales">
            <table>
                <tr>
                    <th>Month-Year</th>
                    <th>Average Sales</th>
                </tr>
                <tr>
                    <td>January-2024</td>
                    <td>$500</td>
                </tr>
                <tr>
                    <td>February-2024</td>
                    <td>$600</td>
                </tr>
            </table>
        </div>
        <div class="tab-content" id="requests">
            <table>
                <tr>
                    <th>User ID</th>
                    <th>Request</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ticket Sale</td>
                    <td>Pending</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ticket Sale</td>
                    <td>Resolved</td>
                </tr>
            </table>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
    </footer>
</body>
</html>

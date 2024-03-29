<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <!-- stylesheets -->
    <link rel="stylesheet" href="css/loginStyling.css" />
    <link rel="stylesheet" href="css/headerFooter.css" />
    <!-- stylesheets -->

    <!-- Scripts -->
    <script src="script/loginScript.js"></script>
    <?php include("php/loginAction.php"); ?>
    <!-- Scripts -->
  </head>
  <body>
    <header>
      <h1>
        <a
          href="browseTickets.html"
          style="color: inherit; text-decoration: none"
          >TicketHub</a
        >
      </h1>
      <ul>
        <!-- <li><a href="cart.html">View Cart</a></li>  -->
        <li><a href="signup.html">Sign Up</a></li>
      </ul>
    </header>
    <div class="loginContainer">
      <h3>Login</h3>
      <form
        id="loginForm"
        action="php/loginAction.php"
        method="post"
      >
        <label for="username">Username:</label>
        <input
          class="username-input"
          type="text"
          id="username"
          name="username"
        />
        <label for="password">Password:</label>
        <input
          class="password-input"
          type="password"
          id="password"
          name="password"
        />

        <?php
            // check to see if the session array is set
            if(isset($_SESSION['loginErrors'])){
              // iterate through the errors 
              foreach($_SESSION['loginErrors'] as $error){
                // echo the error(s) to the screen under the password
                echo "<p class='error-message'>$error</p>";
              }
              // After errors are displayed unset the session array
              unset($_SESSION["loginErrors"]);
            }
        ?>

        <input type="submit" value="Login" />
      </form>
      <p>Don't have an account with us? Sign Up!</p>
      <input
        type="button"
        value="Sign Up"
        onclick="window.location.href='signup.html';"
      />
    </div>
    <footer>
      <p>&copy; 2024 Ticket Hub. All Rights Reserved.</p>
    </footer>
  </body>
</html>

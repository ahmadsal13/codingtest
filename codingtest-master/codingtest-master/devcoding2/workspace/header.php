<?php
  session_start();
  require "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="This is an example of a meta description. This will often show up in search results.">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="/css/login.css">
  </head>
  <body>

    <header class="loginheader">
      <nav class="nav-header-main">
        <a class="header-logo" href="mainlogin.php">
          <img src="/images/logo.PNG" alt="Team logo">
        </a>
        <ul>
          <li><a href="mainlogin.php">Home</a></li>
          <li><a href="#">Portfolio</a></li>
          <li><a href="#">About me</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
      <div class="header-login">
        <!-- The "inputs" decided to have in the form include username/e-mail and password. The user will be able to choose whether to login using e-mail or username.

        // It can choose whether or not to show the login/signup form, or to show the logout form, if they are logged in or not. -->
        <?php
        if (!isset($_SESSION['id'])) {
          echo '<form action="includes/login.inc.php" method="post">
            <input type="text" name="mailuid" placeholder="E-mail/Username">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="login-submit">Login</button>
          </form>
          <a href="signup.php" class="header-signup">Signup</a>';
        }
        else if (isset($_SESSION['id'])) {
          echo '<form action="includes/logout.inc.php" method="post">
            <button type="submit" name="login-submit">Logout</button>
          </form>';
        }
        ?>
      </div>
    </header>
</body>
</html>

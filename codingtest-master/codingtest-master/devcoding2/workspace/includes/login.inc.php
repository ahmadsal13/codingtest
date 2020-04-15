<?php
// Here it checks whether the user got to this page by clicking the proper login button.
if (isset($_POST['login-submit'])) {
  
  require 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  // It checks for any empty inputs. 
  if (empty($mailuid) || empty($password)) {
    header("Location: ../mainlogin.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  else {

    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
    $stmt = mysqli_stmt_init($conn2);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // If there is an error it sends the user back to the signup page.
      header("Location: ../mainlogin.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        // Then it matches the password from the database with the password the user submitted.
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        // If they don't match then it creates an error message!
        if ($pwdCheck == false) {
          // If there is an error it sends the user back to the signup page.
          header("Location: ../mainlogin.php?error=wrongpwd");
          exit();
        }
        // Then if they DO match, then it knows it is the correct user that is trying to log in!
        else if ($pwdCheck == true) {

          session_start();
          $_SESSION['id'] = $row['idUsers'];
          $_SESSION['uid'] = $row['uidUsers'];
          $_SESSION['email'] = $row['emailUsers'];
          // Now the user is registered as logged in and it can now take them back to the front page! 
          header("Location: ../mainlogin.php?login=success");
          exit();
        }
      }
      else {
        header("Location: ../mainlogin.php?login=wronguidpwd");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn2);
}
else {
  // If the user tries to access this page an inproper way, it sends them back to the signup page.
  header("Location: ../signup.php");
  exit();
}

<?php
// Here it checks whether the user got to this page by clicking the proper signup button.
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }
  // This checks for an invalid username AND invalid e-mail.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invaliduidmail");
    exit();
  }
  // This checks for an invalid username.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  // This checks for an invalid e-mail.
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
  }
  // This checks if the repeated password is NOT the same.
  else if ($password !== $passwordRepeat) {
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
  else {

    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?;";
    $stmt = mysqli_stmt_init($conn2);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // If there is an error this sends the user back to the signup page.
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCount = mysqli_stmt_num_rows($stmt);
      mysqli_stmt_close($stmt);
      if ($resultCount > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }
      else {
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn2);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          // If there is an error this sends the user back to the signup page.
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else {
		$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);
          // This sends the user back to the signup page with a success message!
          header("Location: ../signup.php?signup=success");
          exit();

        }
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

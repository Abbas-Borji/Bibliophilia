<?php
  // Start the session
  session_start();

  // Unset the 'username' session variable
  unset($_SESSION['username']);

  // Redirect the user to the login page
  header("Location: login.php");
?>

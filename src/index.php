<?php 
include "php/registerScript.php";
include "php/loginScript.php";

ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Registration Form</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css"/>
</head>
<body>
  <h1>Login and Registration Form</h1>

  <div class="form-container">
    <!-- Login Form -->
    <form action="php/loginScript.php" method="post" id="loginForm">
      <h2>Login</h2>
      <div>
        <label for="loginUsername">Username</label>
        <input class="login-input" type="text" name="existingUser" id="loginUsername" required>
      </div>
      <div>
        <label for="loginPassword">Password</label>
        <input class="login-input" type="password" name="existingPassword" id="loginPassword" required>
      </div>
      <button id="submit-button" type="submit">Log In</button>
    </form>

    <!-- Registration Form -->
    <form action="php/registerScript.php" method="post" id="registrationForm" >
      <h2>Registration</h2>
      <div>
        <label for="regUsername">Username</label>
        <input class="login-input" type="text" name="newUserName" id="regUsername" required>
      </div>
      <div>
        <label for="regEmail">Email</label>
        <input class="login-input" type="email" name="newUserEmail" id="regEmail" required>
      </div>
      <div>
        <label for="regPassword">Password</label>
        <input class="login-input" type="password" name="newUserPassword" id="regPassword" required>
      </div>
      <div>
        <label for="regConfirmPassword">Confirm Password</label>
        <input class="login-input" type="password" id="regConfirmPassword" name="newUserConfirmPassword" required>
      </div>
      <button id="submit-button" type="submit">Register</button>
    </form>
  </div>

  <script src="js/register.js"></script>
</body>
</html>
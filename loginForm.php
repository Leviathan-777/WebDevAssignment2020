<?php
ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	     <meta charset="UTF-8">
      <link rel="shortcut icon" href="#">
      <meta name="description" content="Bookstore">
      <meta name="author" content="Mateusz Beclawski">
      <link rel="stylesheet" href="css/style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login Form</title>
</head>
<body>
   <div class="grid-container">
         <?php
         require_once("functions.php");
         $loginMenu = checkLoginPage();
         $menuArray = array ("index.php" => "HOME", "chooseBook.php" => "EDIT BOOK", "orderBooksForm.php" => "ORDER BOOK", "credits.php" => "CREDITS", $loginMenu['loginPage'] => $loginMenu['name']);
         echo makeHeader();  
         echo makeNavMenu($menuArray, "loginForm.php"); ?>
         <main>
<form id="loginForm" method="post" action="loginProcess.php">
      <h1>Log In</h1>
      <p>Enter your details to login</p>
      <br>
      <input class="login" type="text" placeholder="Username" name="username" required>
      <br>
      <input class="login" type="password" placeholder="Password"  name="password" required>
      <br>
      <button class="login" type="submit" value="Login">Login</button>
</form>
</main>
</div>
<script type="text/javascript" src="functions.js"></script>
</body>
</html>
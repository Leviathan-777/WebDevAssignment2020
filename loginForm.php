<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<title>Login Form</title>
</head>
<body>
   <div class="grid-container">
         <header>
            <form  class="loginBar" method="post" action="loginProcess.php">
            <input class='login' type="text" placeholder="Username" name="username" required>
               <br>
               <input class='login' type="password" placeholder="Password" name="password" required>
               <br>
               <button class='login' type="submit" value="Login">Login</button>
            </form>
         </header>
         <?php $menuArray = array ("index.php" => "HOME", "chooseBook.php" => "EDIT BOOK", "orderBooksForm.php" => "ORDER BOOK", "credits.php" => "CREDITS", "loginForm.php" => "LOGIN");
         require_once("functions.php");
         echo makeNavMenu($menuArray, "loginForm.php"); ?>
	<div class="overlay">
<form method="post" action="loginProcess.php">
   <div class="container">
   <header class="head-form">
      <h1>Log In</h1>
      <p>Enter your details to login</p>
   </header>
   <br>
   <div class="field-set">
         <input class="form-input" id="txt-input" type="text" placeholder="Username" name="username" required>
      <br>
      <input class="form-input" type="password" placeholder="Password" id="pwd"  name="password" required>
      <br>
      <button class="log-in" type="submit" value="Login">Login</button>
   </div>
  </div>
  </div>
</form>
</div>
</body>
</html>
<?php
ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
if (isset($_SESSION ['logged-in']) && $_SESSION ['logged-in']) {
	echo "<p>Welcome! This page could now display information / provide functionality that you want to restrict access to.</p>\n";
}
else{
	echo "<p>You need to login to access this page.</p>
	<a href='http://unn-w18030605.newnumyspace.co.uk/loginForm.php'>Login</a>";
}
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
	<title>Restricted</title>
</head>
<body>
<div class="grid-container">
			<header>
				<form class="loginBar" method="post" action="loginProcess.php">
				<input class='login' type="text" placeholder="Username" name="username" required>
      			<br>
      			<input class='login' type="password" placeholder="Password" name="password" required>
      			<br>
      			<button class='login' type="submit" value="Login">Login</button>
				</form>
			</header>
			<?php $menuArray = array ("index.php" => "HOME", "chooseBook.php" => "EDIT BOOK", "orderBooksForm.php" => "ORDER BOOK", "credits.php" => "CREDITS", "loginForm.php" => "LOGIN");
			require_once("functions.php");
			echo makeNavMenu($menuArray, "chooseBook.php"); ?>
		</div>
</body>
</html>
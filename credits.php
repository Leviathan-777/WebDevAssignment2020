<?php
ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Bookstore">
	<meta name="author" content="Mateusz Beclawski">
	<link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Credits</title>
</head>
<body>
	<div class="grid-container">
		<?php
		require_once("functions.php");
		$loginMenu = checkLoginPage();
		$menuArray = array ("index.php" => "HOME", "chooseBook.php" => "EDIT BOOK", "orderBooksForm.php" => "ORDER BOOK", "credits.php" => "CREDITS", $loginMenu['loginPage'] => $loginMenu['name']);
		echo makeHeader();  
		echo makeNavMenu($menuArray, "credits.php"); ?>
		<main>
			<div>
				<h1>Credits and References</h1>
				<div id='account'>
					<h2>Credits:</h2>
					<p>Author: Matuesz Beclawski</p>
					<p>Student ID: 18030605</p>
					<h2>References:</h2>
					<p>W3schools.com. 2021. HTML Tutorial. [online] Available at: <a href="https://www.w3schools.com/html/default.asp">Link</a> [Accessed 3 January 2021].<p>
					<p>W3schools.com. 2021. CSS Tutorial. [online] Available at: <a href="https://www.w3schools.com/css/default.asp">Link</a> [Accessed 3 January 2021].<p>
					<p>W3schools.com. 2021. JavaScript Tutorial. [online] Available at: <a href="https://www.w3schools.com/js/default.asp">Link</a> [Accessed 3 January 2021].<p>
					<p>W3schools.com. 2021. PHP Tutorial. [online] Available at: <a href="https://www.w3schools.com/php/default.asp">Link</a> [Accessed 3 January 2021].<p>
				</div>
			</div>
		</main>
		<footer>
			<p>Mateusz Beclawski. Student ID: 18030605</p>
		</footer>
	</div>
	<script type="text/javascript" src="functions.js"></script>
</body>
</html>
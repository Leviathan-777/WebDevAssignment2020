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
	<title>Restricted</title>
</head>
<body>
	<div class="grid-container">
		<?php
		require_once("functions.php");
		$loginMenu = checkLoginPage();
		$menuArray = array ("index.php" => "HOME", "chooseBook.php" => "EDIT BOOK", "orderBooksForm.php" => "ORDER BOOK", "credits.php" => "CREDITS", $loginMenu['loginPage'] => $loginMenu['name']);
		echo makeHeader();  
		echo makeNavMenu($menuArray, ""); ?>
		<main>
			<h1>You need to login to access this page.</h1>;
		</main>
	</div>
</body>
<script type="text/javascript" src="functions.js"></script>
</html>
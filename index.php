<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Bookstore">
		<meta name="author" content="Mateusz Beclawski">
		<link rel="stylesheet" href="css/style1.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Main Page</title>
	</head>
	<body>
		<div class="grid-container">
			<header>
				<a id='login' href='loginForm.php'>LOG IN</a>
			</header>
			<?php $menuArray = array ("index.php" => "HOME", "chooseBook.php" => "EDIT BOOK", "orderBooksForm.php" => "ORDER BOOK", "credits.php" => "CREDITS", "loginForm.php" => "LOGIN");
			require_once("functions.php");
			echo makeNavMenu($menuArray, "index.php"); ?>
			</div>
			<main>
				<div>
				<h1>Bookstore</h1>
				<p>Main Page</p>
				</div>
				<aside id='offers'></aside>
				<aside id='JSONoffers'></aside>
			</main>
			<footer>
				<p>Mateusz Beclawski. Student ID: 18030605</p>
			</footer>
		</div>
		
	</body>
</html>
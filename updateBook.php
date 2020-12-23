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
	<title>Update Book</title>
</head>
<body>
	<div class="grid-container">
		<?php
		require_once("functions.php");
		$loginMenu = checkLoginPage();
		$menuArray = array ("index.php" => "HOME", "chooseBook.php" => "EDIT BOOK", "orderBooksForm.php" => "ORDER BOOK", "credits.php" => "CREDITS", $loginMenu['loginPage'] => $loginMenu['name']);
		echo makeHeader();  
		echo makeNavMenu($menuArray, "chooseBook.php"); ?>
		<main>
			<?php
			require_once("functions.php");
			list($input, $errors) = validate_form();
			if ($errors!=null) {
				//print_r($errors);
				echo show_errors($input, $errors);
			} 
			else {
				echo process_form($input);
			}
			?>
		</main>
		<footer>
			<p>Mateusz Beclawski. Student ID: 18030605</p>
		</footer>
	</div>
	<script type="text/javascript" src="functions.js"></script>
</body>
</html>
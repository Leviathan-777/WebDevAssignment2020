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
			echo makeNavMenu($menuArray, "chooseBook.php"); ?>
			<main>
<?php
require_once("functions.php");
list($input, $errors) = validate_form();
if ($errors!=null) {
	print_r($errors);
	echo show_errors($input, $errors);
} 
else {
	echo process_form($input);
}
?>
</main>
</div>
<script type="text/javascript" src="functions.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
		<link rel="shortcut icon" href="#">
		<meta name="description" content="Bookstore">
		<meta name="author" content="Mateusz Beclawski">
		<link rel="stylesheet" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit details of book</title>
</head>
<body>
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
			<main>
<h1>Edit details of book:</h1>
<form id="updateBook" action="updateBook.php" method="get">
	<?php
	$bookISBN = isset($_REQUEST['bookISBN']) ? $_REQUEST['bookISBN'] : null;
	try{
	require_once("functions.php");
	$dbConn = getConnection();
	$sqlQuery = "SELECT bookTitle, bookYear, catDesc, bookPrice, pubName, location
		FROM NBL_books
		INNER JOIN NBL_category
		ON NBL_category.catID = NBL_books.catID
		INNER JOIN NBL_publisher
		ON NBL_publisher.pubID = NBL_books.pubID
		WHERE bookISBN=$bookISBN";
	$sqlQueryCat = "SELECT catDesc, catID
		FROM NBL_category
		ORDER BY catDesc";
	$queryCat = $dbConn->query($sqlQueryCat);
	$sqlQueryPub = "SELECT pubName, pubID
		FROM NBL_publisher
		ORDER BY pubName";
	$queryPub = $dbConn->query($sqlQueryPub);
	$queryResult = $dbConn->query($sqlQuery);
	$rowObj = $queryResult->fetchObject();
	echo "<label>Title</label><br>";
	echo "<input type='text' name='bookTitle' required value='{$rowObj->bookTitle}'><br>";
	echo "<label>Category</label><br>";
	echo"<select name='catID'>";
	while ($rowCat = $queryCat->fetchObject()) {
	if ($rowCat->catDesc == $rowObj->catDesc){
	$selected = 'selected';
	} 
	else {
	$selected = ''; 
	}

		echo "<option value={$rowCat->catID} $selected>{$rowCat->catDesc}</option>";
	}
	echo"</select><br>";
	echo "<label>Publisher</label><br>";
	echo"<select name='pubID'>";
	while ($rowPub = $queryPub->fetchObject()) {
	if ($rowPub->pubName == $rowObj->pubName){
	$selected = 'selected';
	} 
	else {
	$selected = ''; 
	}

		echo "<option value={$rowPub->pubID} $selected>{$rowPub->pubName}</option>";
	}
	echo "</select><br>";
	echo "<label>Year </label><br>";
	echo "<input type='number' name='bookYear' required value='{$rowObj->bookYear}'><br>";
	echo "<label>Price </label><br>";
	echo "<input type='text' name='bookPrice' required value='{$rowObj->bookPrice}'><br>";
	}
	catch(Execption $e){
    echo "<p>Error: ".$e->getMessage()."</p>\n";
    }
    echo "<input type='hidden' name='bookISBN' value=$bookISBN>";
	?>
	<input type="submit" value="Edit Book">
</form>
</main>
</div>
<script type="text/javascript" src="functions.js"></script>
</body>
</html>
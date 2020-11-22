<?php
require_once("functions.php");
restrictedSession();
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
	<title>Choose a book to edit</title>
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
			<h1>Choose book to edit</h1>
			<table class="booksTable">
				<thead>
					<tr>
						<th>Title</th>
						<th>Category</th>
						<th>Year</th>
						<th>Price</th>
					</tr>
				</thead>
				<tbody>
					<?php
					try {
						require_once("functions.php");
						$dbConn = getConnection();

						$sqlQuery = "SELECT bookISBN, bookTitle, bookYear, catDesc, bookPrice
						FROM NBL_books
						INNER JOIN NBL_category
						ON NBL_category.catID = NBL_books.catID
						ORDER BY bookTitle";
						$queryResult = $dbConn->query($sqlQuery);
						
						while ($rowObj = $queryResult->fetchObject()) {
							echo "<tr>\n
							<td class='bookTitle'><a href='editBook.php?bookISBN={$rowObj->bookISBN}'>{$rowObj->bookTitle}</a></td>
							<td class='catDesc'>{$rowObj->catDesc}</td>
							<td class='bookYear'>{$rowObj->bookYear}</td>
							<td class='bookPrice'>{$rowObj->bookPrice}</td></tr>";
						}
					}
					catch (Exception $e){
						echo "<p>Query failed: ".$e->getMessage()."</p>\n";
					}
					?>
				</tbody>
			</table>
		</main>
	</div>
	<script type="text/javascript" src="functions.js"></script>
</body>
</html>
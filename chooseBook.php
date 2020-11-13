<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<title>Choose a book to edit</title>
</head>
<body>
	<nav>
				<ul>
		  			<li><a href="index.html">HOME</a></li>
		  				<li><a href="chooseBook.php">EDIT BOOK</a></li>
		  				<li><a href="orderBooksForm.php">ORDER BOOK</a></li>
		  				<li><a href="credits.php">CREDITS</a></li>
		  				<li><a href="loginForm.php">LOGIN</a></li>
				</ul>
			</nav>
	<h1>Choose book to edit:</h1>
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
</body>
</html>
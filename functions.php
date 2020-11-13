<?php
function getConnection() {
	try {
		$connection = new PDO("mysql:host=localhost;dbname=unn_w18030605",
			"unn_w18030605", "");
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $connection;
	} catch (Exception $e) {
		throw new Exception("Connection error ". $e->getMessage(), 0, $e);
	}
}
function checkCategories(){
	$dbConn = getConnection();
	$sqlQueryCat = "SELECT catID
	FROM NBL_category";
	$queryCat = $dbConn->query($sqlQueryCat);
	$categories = array();
	while ($rowCat=$queryCat->fetchColumn()) {
		$categories[]=$rowCat;
	}
	return $categories;
}
function checkPublishers(){
	$dbConn = getConnection();
	$sqlQueryPub = "SELECT pubID
	FROM NBL_publisher";
	$queryPub = $dbConn->query($sqlQueryPub);
	$publishers = array();
	while ($rowPub=$queryPub->fetchColumn()) {
		$publishers[]=$rowPub;
	}
	return $publishers;
}
function validate_form() {
	$publishers = checkPublishers();
	$categories = checkCategories();
	$input = array();
	$errors = array();
	/*$errors['bookTitle'] = null;
	$errors['bookPrice']= null;
	$errors['bookYear'] = null;*/

	$input['bookTitle'] = filter_has_var(INPUT_GET, 'bookTitle') 
	? $_GET['bookTitle']: null;
	$input['bookTitle'] = trim($input['bookTitle']);

	$input['pubID'] = filter_has_var(INPUT_GET, 'pubID') 
	? $_GET['pubID']: null;
	$input['pubID'] = trim($input['pubID']);

	$input['catID'] = filter_has_var(INPUT_GET, 'catID') 
	? $_GET['catID']: null;
	$input['catID'] = trim($input['catID']);

	$input['bookPrice'] = filter_has_var(INPUT_GET, 'bookPrice') 
	? $_GET['bookPrice']: null;
	$input['bookPrice'] = trim($input['bookPrice']);

	$input['bookYear'] = filter_has_var(INPUT_GET, 'bookYear') 
	? $_GET['bookYear']: null;
	$input['bookYear'] = trim($input['bookYear']);

	$input['bookISBN'] = filter_has_var(INPUT_GET, 'bookISBN') 
	? $_GET['bookISBN']: null;
	$input['bookISBN'] = trim($input['bookISBN']);

	if (empty($input['bookTitle'])) {
		$errors[] = "Book title is empty";
	}
	if (empty($input['bookPrice'])) {
		$errors[] = "Price field is empty";
	}
	elseif (!filter_var($input['bookPrice'], FILTER_VALIDATE_FLOAT)){
		$errors['bookPrice'] = "Enter valid price";
	}
	if (empty($input['bookYear'])) {
		$errors[] = "Year field is empty";
	}
	elseif ($input['bookYear']<0 or  !filter_var($input['bookYear'], FILTER_VALIDATE_INT)) {
		$errors['bookYear'] = "Enter valid year";
	}
	/*if(strlen($input['bookTitle'])>50){
		$errors['bookTitle'] = "Book title too long";
	}*/
	
	if (!in_array($input['catID'], $categories)) {
		$errors[] = "Wrong category";
	}
	if (!in_array($input['pubID'], $publishers)) {
		$errors[] = "Wrong publisher";
	}
	return array ($input, $errors);
}
function show_errors($input, $errors){
	$output = "Errors: ";
	foreach ($errors as $error) {
		$output .= "<p>$error</p>\n";
	}
	echo "$output";
	if(array_key_exists('bookTitle', $errors))
		{$bookTitle = $input['bookTitle'];}
	else{
		$bookTitle = null;
	}
	if(array_key_exists('bookPrice', $errors))
		{$bookPrice = $input['bookPrice'];}
	else{
		$bookPrice = null;
	}
	$formlink = "http://unn-w18030605.newnumyspace.co.uk/editBook.php?bookTitle=$bookTitle&bookPrice=$bookPrice";
	echo "<a href='$formlink'>Fill the form correctly</a>";
}
function process_form($input){
	$bookTitle = $input['bookTitle'];
	$bookPrice = $input['bookPrice'];
	$catID = $input['catID'];
	$pubID = $input['pubID'];
	$bookYear = $input['bookYear'];
	$bookISBN = $input['bookISBN'];
	try {
		$dbConn = getConnection();
		$sqlUpdate = "UPDATE NBL_books
		SET bookTitle = :bookTitle, bookYear = :bookYear, pubID = :pubID, catID = :catID, bookPrice = :bookPrice
		WHERE bookISBN = :bookISBN";
		$stmt = $dbConn->prepare($sqlUpdate);
		$stmt->execute(array(':bookISBN' => $bookISBN, ':bookTitle' => $bookTitle, ':bookYear' => $bookYear, ':pubID' => $pubID, ':catID' => $catID, ':bookPrice' => $bookPrice,));

		echo "<h1>Book has been updated</h1>\n";
		echo "<p>Title: $bookTitle</p>\n";
		echo "<p>Category: $catID</p>\n";
		echo "<p>Publisher: $pubID</p>\n";
		echo "<p>Price: $bookPrice</p>\n";
		echo "<p>Year: $bookYear</p>\n";
	}
	catch (Exception $e) {
		echo "Error: $e";
	}
}
function makeNavMenu($menuOptions) {
	$options = "<ul>\n";
	foreach ($menuOptions as $key=>$value) {
		$options .= "<li <a href='$key'>$value</a></li>\n";
	}
	$options .= "</ul>\n";
	$navMenuContent = <<<NAVMENU
		<nav>
				$options
		</nav>
NAVMENU;
	$navMenuContent .= "\n";
	return $navMenuContent;
}

?>

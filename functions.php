<?php
function getConnection() { // Establish connection with database
	try {
		$connection = new PDO("mysql:host=localhost;dbname=unn_w18030605",
			"unn_w18030605", "oD6e6A6Po");
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $connection;
	} catch (Exception $e) {
		throw new Exception("Connection error ". $e->getMessage(), 0, $e);
	}
}
function restrictedSession(){ //Create restricted session
	ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
if($_SESSION['logged-in']==false){
	header("Location: restricted.php");
	exit();
}
}
function makeHeader(){ // Make HTML header
	if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']==true){
		$headerContent = "<header><a class='logout' href='logoutProcess.php' class='logout'>Logout</a></header>";
	}
	else{
	$headerContent = <<<HEADER
		<header>
				<form  class="loginBar" method="post" action="loginProcess.php">
				<input class='login' type="text" placeholder="Username" name="username" required>
      			<br>
      			<input class='login' type="password" placeholder="Password" name="password" required>
      			<br>
      			<button class='login' type="submit" value="Login">Login</button>
				</form>
			</header>
HEADER;
}
return $headerContent;
}
function checkCategories(){ // Retrive categories ID from database
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
function checkPublishers(){ // Retrive publishers ID from database
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
function validate_form() { // Edit book form validation
	$publishers = checkPublishers();
	$categories = checkCategories();
	$input = array();
	$errors = array();
	/*$errors['bookTitle'] = null;
	$errors['bookPrice']= null;
	$errors['bookYear'] = null;*/
	//Validate and santize input
	$input['bookTitle'] = filter_has_var(INPUT_GET, 'bookTitle') 
	? $_GET['bookTitle']: null;
	$input['bookTitle'] = trim($input['bookTitle']);
	$input['bookTitle'] = filter_var($input['bookTitle'], FILTER_SANITIZE_STRING);

	$input['pubID'] = filter_has_var(INPUT_GET, 'pubID') 
	? $_GET['pubID']: null;
	$input['pubID'] = trim($input['pubID']);
	$input['pubID'] = filter_var($input['pubID'], FILTER_SANITIZE_STRING);

	$input['catID'] = filter_has_var(INPUT_GET, 'catID') 
	? $_GET['catID']: null;
	$input['catID'] = trim($input['catID']);
	$input['catID'] = filter_var($input['catID'], FILTER_SANITIZE_STRING);

	$input['bookPrice'] = filter_has_var(INPUT_GET, 'bookPrice') 
	? $_GET['bookPrice']: null;
	$input['bookPrice'] = trim($input['bookPrice']);
	$input['bookPrice'] = filter_var($input['bookPrice'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

	$input['bookYear'] = filter_has_var(INPUT_GET, 'bookYear') 
	? $_GET['bookYear']: null;
	$input['bookYear'] = trim($input['bookYear']);
	$input['bookYear'] = filter_var($input['bookYear'], FILTER_SANITIZE_NUMBER_INT);

	$input['bookISBN'] = filter_has_var(INPUT_GET, 'bookISBN') 
	? $_GET['bookISBN']: null;
	$input['bookISBN'] = trim($input['bookISBN']);
	$input['bookISBN'] = filter_var($input['bookISBN'], FILTER_SANITIZE_NUMBER_INT);

	if (empty($input['bookTitle'])) {
		$errors[] = "Book title is incorrect";
	}
	if (empty($input['bookPrice'])) {
		$errors[] = "Price field is incorrect";
	}
	elseif (!filter_var($input['bookPrice'], FILTER_VALIDATE_FLOAT)){
		$errors['bookPrice'] = "Enter valid price";
	}
	if (empty($input['bookYear'])) {
		$errors[] = "Year field is incorrect";
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
function show_errors($input, $errors){ //Shows errors
	echo "<h1>Errors</h1>";
	$output = "";
	foreach ($errors as $error) {
		$output .= "<p>$error</p>\n";
	}
	echo "<div id='account'>$output";
	$bookISBN = $input['bookISBN'];
	if(array_key_exists('bookTitle', $errors))
		$bookTitle = null;
	else{
		$bookTitle = $input['bookTitle'];
	}
	if(array_key_exists('bookPrice', $errors))
		$bookPrice = null;
	else{
		$bookPrice = $input['bookPrice'];
	}
	$formlink = "http://unn-w18030605.newnumyspace.co.uk/editBook.php?bookISBN=$bookISBN";
	echo "<a href='$formlink'>Fill the form correctly</a></div>";
}
function process_form($input){ //Process santized and validated input, send it to database, inform user about sucessful operation
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
		echo "<<div id='account'>\n";
		echo "<p>Title: $bookTitle</p>\n";
		echo "<p>Category: $catID</p>\n";
		echo "<p>Publisher: $pubID</p>\n";
		echo "<p>Price: $bookPrice</p>\n";
		echo "<p>Year: $bookYear</p></div>\n";
	}
	catch (Exception $e) {
		echo "Error: $e";
	}
}
function makeNavMenu($menuOptions, $active) { //Creates HTML menu
	$options = "";
	$act = "";
	foreach ($menuOptions as $key=>$value) {
		if($active==$key){
		$act = "class='active'";
		}
		$options .= "<a $act href='$key'>$value</a>\n";
		$act = "";
	}
	$options .= "<a href='javascript:void(0);' class='icon' onclick='mobileMenu()'>&#9776;</a>";
	$navMenuContent = <<<NAVMENU
		<nav class="menu" id="menuM">
				$options
		</nav>
NAVMENU;
	$navMenuContent .= "\n";
	return $navMenuContent;
}
function checkLoginPage(){ // Check if user logged, if yes show account page instead of login page
	if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']==true){
				$loginPage = "accountDetails.php";
				$name = "ACCOUNT";
			}
			else{
				$loginPage = "loginForm.php";
				$name = "LOGIN";
			}
			$loginMenu = array();
			$loginMenu['loginPage'] = $loginPage;
			$loginMenu['name'] = $name;
			return $loginMenu;
}
?>
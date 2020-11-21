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
	<title>Account Details</title>
</head>
<body>
	<div class="grid-container">
			<?php
			require_once("functions.php");
			$loginMenu = checkLoginPage();
			$menuArray = array ("index.php" => "HOME", "chooseBook.php" => "EDIT BOOK", "orderBooksForm.php" => "ORDER BOOK", "credits.php" => "CREDITS", $loginMenu['loginPage'] => $loginMenu['name']);
			echo makeHeader();  
			echo makeNavMenu($menuArray, "acoountDetails.php"); ?>
			<main>
	
<?php
try {
require_once("functions.php");
$dbConn = getConnection();

$querySQL = "SELECT firstname, surname
FROM NBL_users WHERE userID=:userID";
$stmt = $dbConn->prepare($querySQL);
$userID =  $_SESSION['userID'];
$stmt->execute(array(':userID' => $userID));
$user = $stmt->fetchObject();
echo "<div id='account'><h1>Your Account Details</h1><p>Firstname: $user->firstname</p>";
echo "<p>Surname: $user->surname</p></div>";
}
catch (Exception $e) {
			echo "There was a problem: " . $e->getMessage();
             }
?>

</main>
</div>
<script type="text/javascript" src="functions.js"></script>
</body>
</html>
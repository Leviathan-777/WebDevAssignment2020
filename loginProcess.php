<?php
ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
//Validation
$username = filter_has_var(INPUT_POST, 'username') 
? $_POST['username']: null;
$password = filter_has_var(INPUT_POST, 'password') 
? $_POST['password']: null;
$username = trim($username);
$password = trim($password);
$username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
$password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
if(empty($password) || empty($username)){
	echo "<p>Username or password is incorrect</p>";
	exit();
} 
try {
// Establishes a database connection
	require_once("functions.php");
	$dbConn = getConnection();

	/* Query the users database table to get the password hash for the username entered by the user */
	$querySQL = "SELECT passwordHash, userID FROM NBL_users
	WHERE username = :username";

// Prepares the sql statement
	$stmt = $dbConn->prepare($querySQL);

// Executes the query
	$stmt->execute(array(':username' => $username));

	/* Checks if a record was returned by the query*/
	$user = $stmt->fetchObject();
	if ($user) {
		$passwordHash = $user->passwordHash;
		if(password_verify( $password , $passwordHash)){
			echo "<p>Logon was successful</p>";
			$_SESSION['logged-in']=true;
			$_SESSION['userID']=$user->userID;
			if($_SERVER['HTTP_REFERER'] === 'http://unn-w18030605.newnumyspace.co.uk/restricted.php'){
				header('Location: chooseBook.php');
				exit();
			}
			if($_SERVER['HTTP_REFERER'] == 'http://unn-w18030605.newnumyspace.co.uk/loginForm.php'){
				header('Location: accountDetails.php');
				exit();
			}
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit();
		}
		else {
			echo "<p>Username or password is incorrect</p>";
		}
	}
	else {
		echo "<p>Username or password is incorrect</p>";
	}
} catch (Exception $e) {
	echo "There was a problem: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<script type="text/javascript" src="functions.js"></script>
</body>
</html>
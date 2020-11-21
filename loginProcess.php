<?php
ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
//Do validation
$username = filter_has_var(INPUT_POST, 'username') 
? $_POST['username']: null;
$password = filter_has_var(INPUT_POST, 'password') 
? $_POST['password']: null;

try {
// Make a database connection
require_once("functions.php");
		$dbConn = getConnection();

/* Query the users database table to get the password hash for the username entered by the user */
		$querySQL = "SELECT passwordHash, userID FROM NBL_users
WHERE username = :username";

// Prepare the sql statement
		$stmt = $dbConn->prepare($querySQL);

// Execute the query
		$stmt->execute(array(':username' => $username));

/* Check if a record was returned by the query*/
$user = $stmt->fetchObject();
if ($user) {
	$passwordHash = $user->passwordHash;
	if(password_verify( $password , $passwordHash)){
		echo "<p>Logon was successful</p>";
		$_SESSION['logged-in']=true;
		$_SESSION['userID']=$user->userID;
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
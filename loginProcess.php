<?php
ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
/* Retrieve the username and the password from the form (note you should also do appropriate validation – not included here) */
$username = filter_has_var(INPUT_POST, 'username') 
? $_POST['username']: null;
$password = filter_has_var(INPUT_POST, 'password') 
? $_POST['password']: null;

try {
// Make a database connection
require_once("functions.php");
		$dbConn = getConnection();

/* Query the users database table to get the password hash for the username entered by the user, using a PDO named placeholder for the username */
		$querySQL = "SELECT passwordHash FROM users 
WHERE username = :username";

// Prepare the sql statement using PDO
		$stmt = $dbConn->prepare($querySQL);

// Execute the query using PDO
		$stmt->execute(array(':username' => $username));

/* Check if a record was returned by the query. If yes, then there was a username matching what was entered in the logon form and we can test (we will add code to shortly) to see if the password entered in the logon form was correct. Otherwise, indicate an error. */

$user = $stmt->fetchObject();
if ($user) {
	$passwordHash = $user->passwordHash;
	if(password_verify( $password , $passwordHash)){
		echo "<p>Logon was successful</p><a href='http://unn-w18030605.newnumyspace.co.uk/restricted.php'>Main</a>";
		$_SESSION['logged-in']=true;
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

</body>
</html>
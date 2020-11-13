<?php
ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
if (isset($_SESSION ['logged-in']) && $_SESSION ['logged-in']) {
	echo "<p>Welcome! This page could now display information / provide functionality that you want to restrict access to.</p>\n";
}
else{
	echo "<p>You need to login to access this page.</p>
	<a href='http://unn-w18030605.newnumyspace.co.uk/loginForm.php'>Login</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Restricted</title>
</head>
<body>

</body>
</html>
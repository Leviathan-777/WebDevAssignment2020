<?php
ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	session_unset();
	session_destroy();
	echo "Successful Log out";
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit();
	?>
</body>
</html>
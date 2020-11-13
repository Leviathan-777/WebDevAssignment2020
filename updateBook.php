<!DOCTYPE html>
<html>
<head>
	<title>Update Book</title>
</head>
<body>
<?php
require_once("functions.php");
list($input, $errors) = validate_form();
if ($errors!=null) {
	print_r($errors);
	echo show_errors($input, $errors);
} 
else {
	echo process_form($input);
}
?>
</body>
</html>
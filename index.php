<?php
ini_set("session.save_path", "/home/unn_w18030605/sessionData");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="#">
	<meta name="description" content="Bookstore">
	<meta name="author" content="Mateusz Beclawski">
	<link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Main Page</title>
</head>
<body>
	<div class="grid-container">
		<?php
		require_once("functions.php");
		$loginMenu = checkLoginPage();
		$menuArray = array ("index.php" => "HOME", "chooseBook.php" => "EDIT BOOK", "orderBooksForm.php" => "ORDER BOOK", "credits.php" => "CREDITS", $loginMenu['loginPage'] => $loginMenu['name']);
		echo makeHeader();  
		echo makeNavMenu($menuArray, "index.php"); ?>
		<main>
			<div>
				<h1>Bookstore Offers</h1>
				
			</div>
			<aside id='offers'></aside>
			<aside id='JSONoffers'></aside>
		</main>
		<footer>
			<p>Mateusz Beclawski. Student ID: 18030605</p>
		</footer>
	</div>
	<script type="text/javascript" src="functions.js"></script>
	<script type="text/javascript">
	window.addEventListener('load', function () {
 	"use strict";
	const getOffers = function(){
	fetch("getOffers.php")
	.then(
		function(response){
			return response.text();
		})
	.then(
		function(data){
			document.getElementById("offers").innerHTML = data;
		})
		.catch(
       	function(err) {
         console.log("Something went wrong!", err);
    	});
	};
	getOffers();
	setInterval(getOffers, 5000);
	
	fetch("getOffers.php?useJSON")
	.then(
		function(response){
			return response.json();
		})
	.then(
		function(data){
			let title = '<p>"' + data.bookTitle + '"<br>';
			let cat = "<span class='category'>Category: " + data.catDesc + "</span><br>";
			let price = "<span class='price'>Price: " + data.bookPrice + "</span></p>";
			document.getElementById("JSONoffers").innerHTML = title + cat + price;
		});
});
</script>
</body>
</html>
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
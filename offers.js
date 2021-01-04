window.addEventListener('load', function () {
 	"use strict";
	const getOffers = function(){ //Function retrives offers and puts them into aside block
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
         console.log("Error: ", err);
    	});
	};
	getOffers();
	setInterval(getOffers, 5000); //Changes offer in 5s periods
	
	fetch("getOffers.php?useJSON") //Function retrives JSON offers and puts them into aside block
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
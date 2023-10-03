<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pok&eacute;dex</title>
	<link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="icon" href="_images/pokeball.jpg">
	<style>
		body, html {
			font-family: "Caveat", cursive;
			text-align: center;
			background-image: linear-gradient(lavender, rgb(100,158,216));
			margin-left: auto;
			margin-right: auto;
		}
		header, footer {
			color: white;
			background-color: #262728;
			font-size: 16px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		#search-button {
			font-weight: bold;
			background-color: #008cba;
			color: white;
			border-radius: 40%;
			transition: 0.4s;
		}
		#search-button:hover {
			background-color: white;
			color: black;
			border: 2px solid #008cba;
		}
		.poke {
			color: white;
			background-color: #343a40;
			font-weight: bold;
			text-align: center;
			float: left;
			width: 200px;
			height: 300px;
			margin: 15px;
			border: 5px black solid;
		}
		.poster {
			height: 50%;
			position: relative;
			border: 1px white solid;
		}
		.poster img {
			margin: auto;
			width: 90%;
			height: 100%;
			display: block;
		}
		.clear {
			clear: both;
		}
	</style>
</head>
<body>
	<header>
		<div class="container">
		    <nav class="main nav">
		    	<img class="float-left" src="_images/mew3.jpg" alt = "Mew0" style="height: 50px;"/>
				<a class="nav-link" href="index.php">Pok&eacute;dex</a>
				<a class="nav-link">Items</a>
				<a class="nav-link" href="about.php">About</a>
				<a class="nav-link" href="http://303.itpwebdev.com/~thomasjf/student_page.html">Student Page</a>
				<?php include 'config/in.php'; ?>
		    </nav>
		</div> <!-- .container -->
	</header>

	<hr><div class="container">
		<img class="float-left" src="_images/mew_gif.gif" alt = "Mew1" style="height: 130px;"/>
		<h1><strong> Another Pok&eacute;mon Game </strong></h1>
		<h4><small><i>Catch 'em All!</i></small></h4>
		<h2><small> Proposed by Thomas Finn </small></h2>
	</div><hr> <!-- .container -->

	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<h2>Kanto Item List</h2>
				<p>
					This is a list of possible items you can get within the game and their purposes for the user. Items will include different types of pokeballs with different catch rates.
				</p>
				<img src="_images/items.jpg" alt="Items" style="height: 130px;"/><br><br>
				<div id="loading-pic">
					<img class="rounded-circle" src="_images/loadingcomplete.jpg" alt="Loading" style="height: 50px;"/>
				</div><br>
				<div id="items"></div><br>
			</div>
			<div class="col-12">
				<nav aria-label="navigation">
					<ul class="pagination justify-content-center">
						<li id="back" class="page-item active">
							<a class="page-link">Go Back</a>
						</li>
					</ul>
				</nav>
			</div> <!-- .col -->
		</div>
	</div> <!-- .container -->

	<hr><footer>
		<p style="color:white"> A website designed by Thomas Finn </p>
		<a href="#">Back to Top</a>
	</footer>

	<!-- JS -->
	<script type="text/javascript">
		// Snorlax placement
		function placeSnorlax(obj) {
			// Prepares header area and empties pokeList area
			var pokeList = document.querySelector("#items");
			while(pokeList.hasChildNodes()) pokeList.removeChild(pokeList.firstChild);
			var text = "Oh no! A snorlax was blocking that search. Try a different search value!";
			// Creating image holder for adding to pokemon div
			var poster = document.createElement("div");
			poster.className = "poster";
			var img = document.createElement("img");
			img.src = "_images/snorlax.gif";
			img.alt = "snorlax-blocked";
			img.className = "rounded-circle";
			poster.appendChild(img);
			// Creating pokemon object and appending
			var poke = document.createElement("div");
			poke.className = "poke";
			var titleText = document.createElement("p");
			titleText.innerHTML = text;
			poke.appendChild(poster);
			poke.appendChild(titleText);
			// Adding to pokeList
			pokeList.appendChild(poke);
			// Adding clear item
			var clr = document.createElement("div");
			clr.className = "clear";
			pokeList.appendChild(clr);
		}
		// Callback function
		function itemSubmit(obj) {
			console.log("Calling back");
			console.log(obj);
			// Prepares header area and empties pokeList area
			var pokeList = document.querySelector("#items");
			while(pokeList.hasChildNodes()) pokeList.removeChild(pokeList.firstChild);
			if(obj.results){
				// Adds array of pokemon with link to call
				for(var i = 0; i < obj.results.length; ++i){
					// Getting needed information
					var profile = "_images/bg3.jpg";
					var name = obj.results[i].name.toUpperCase();
					var call = obj.results[i].url;
					// Get picture from id
					var pic = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/" + obj.results[i].name + ".png";
					// Creating object for clickable search
					var poster = document.createElement("div");
					poster.className = "poster";
					var img = document.createElement("img");
					img.src = (pic) ? pic : profile;
					img.alt = name;
					img.className = "rounded-circle";
					poster.appendChild(img);
					// Creating pokemon object and appending
					var poke = document.createElement("div");
					poke.className = "card poke";
					// Title Text
					var titleText = document.createElement("div");
					titleText.className = "card-header";
					titleText.innerHTML = name;
					// button
					var button = document.createElement("button");
					button.className = "btn btn-outline-light";
					button.innerHTML = "Get Info";
					button.type = "button";
					button.value = call;
					button.onclick = function() {
						console.log(this.value);
						ajax(this.value);
					};
					// Appending children
					poke.appendChild(titleText);
					poke.appendChild(poster);
					poke.appendChild(button);
					// Adding to pokeList
					pokeList.appendChild(poke);
				}
				// Pagination
				document.querySelector("#back").onclick = null;
			} else {
				// Getting needed information
				var profile = obj.sprites.default; 
				var name = obj.names[0].name.toUpperCase();
				var id = obj.id;
				var effect = obj.effect_entries[0].short_effect;
				// Creating image holder for adding to pokemon div
				var poster = document.createElement("div");
				poster.className = "poster";
				var img = document.createElement("img");
				img.src = profile;
				img.alt = name;
				img.className = "rounded-circle";
				poster.appendChild(img);
				// Creating pokemon object and appending
				var poke = document.createElement("div");
				poke.className = "card poke";
				// Title Text
				var titleText = document.createElement("div");
				titleText.className = "card-header";
				titleText.innerHTML = id + ". " + name;
				// Other Info
				var effectText = document.createElement("p");
				effectText.innerHTML = effect;
				// Appending children
				poke.appendChild(titleText);
				poke.appendChild(poster);
				poke.appendChild(effectText);
				// Adding to pokeList
				pokeList.appendChild(poke);
				// Add description
				var statText = document.createElement("div");
				statText.className = "card poke";
				var stats = obj.flavor_text_entries[1].text;
				var header = document.createElement("p");
				header.className = "card-header";
				header.innerHTML = "DESCRIPTION:";
				statText.appendChild(header);
				var stat = document.createElement("p");
				stat.innerHTML = stats;
				statText.appendChild(stat);
				pokeList.appendChild(statText);
				// Pagination
				document.querySelector("#back").onclick = function() { ajax("http://pokeapi.salestock.net/api/v2/item/?limit=16&offset=0"); };
			}
			var clr = document.createElement("div");
			clr.className = "clear";
			pokeList.appendChild(clr);
		}
		// AJAX function
		function ajax(url){
			document.querySelector("#loading-pic img").src = "_images/loading.gif";
			console.log("Performing AJAX");
			var xhr = new XMLHttpRequest();
			xhr.open('GET', url);
			xhr.send();
			xhr.onreadystatechange = function() {
				if(xhr.readyState == XMLHttpRequest.DONE) {
					console.log(xhr.readyState);
					if(xhr.status == 200){
						document.querySelector("#loading-pic img").src = "_images/loadingcomplete.jpg";
						itemSubmit(JSON.parse(xhr.responseText));
					} else {
						document.querySelector("#loading-pic img").src = "_images/loadingcomplete.jpg";
						console.log("Oh no! A snorlax was blocking that search. Try a different search value!");
						placeSnorlax();
					}
				}
			}
		}
	</script>
	<script>ajax("http://pokeapi.salestock.net/api/v2/item/?limit=16&offset=0")</script>
</body>
</html>
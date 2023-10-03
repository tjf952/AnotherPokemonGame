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
			width: 175px;
			height: 350px;
			margin: 15px;
			border: 5px black solid;
		}
		.poster {
			height: 66%;
			position: relative;
			border: 1px white solid;
		}
		.poster img {
			width: 100%;
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
				<a class="nav-link">Pok&eacute;dex</a>
				<a class="nav-link" href="items.php">Items</a>
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
				<h2>Kanto Pok&eacute;dex</h2>
				<p>
					This is a list of Pok&eacute;mon in the order dictated by the Kanto regional Pok&eacute;dex. Introduced in Generation I, this Pok&eacute;dex would serve as the basis for the official listing of all Pok&eacute;mon introduced.
				</p>
				<img class="rounded" src="_images/pokedex.jpg" alt="Pokedex" style="height: 130px;"/>
				<div id="submit-bar" class="search">
					<form action="" method="" class="" id="search-form">
						<input type="text" id="search-input" placeholder="ex: '150' or 'Mewtwo'">
						<button type="submit" id="search-button">Search</button>
					</form>
				</div><br>
				<div id="loading-pic">
					<img class="rounded-circle" src="_images/loadingcomplete.jpg" alt="Loading" style="height: 50px;"/>
				</div><br>
				<div id="pokemon"></div><br>
			</div>
			<div class="col-12">
				<nav aria-label="navigation">
					<ul class="pagination justify-content-center">
						<li id="first" class="page-item">
							<a class="page-link">First</a>
						</li>
						<li id="previous" class="page-item">
							<a class="page-link">Previous</a>
						</li>
						<li id="current" class="page-item active">
							<a class="page-link">Current Page</a>
						</li>
						<li id="next" class="page-item">
							<a class="page-link">Next</a>
						</li>
						<li id="last" class="page-item">
							<a class="page-link">Last</a>
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
			var pokeList = document.querySelector("#pokemon");
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
		function pokeSubmit(obj) {
			console.log("Calling back");
			console.log(obj);
			// Prepares header area and empties pokeList area
			var pokeList = document.querySelector("#pokemon");
			while(pokeList.hasChildNodes()) pokeList.removeChild(pokeList.firstChild);
			if(obj.results){
				// Adds array of pokemon with link to call
				for(var i = 0; i < obj.results.length; ++i){
					// Getting needed information
					var profile = "_images/bg3.jpg";
					var name = obj.results[i].name.toUpperCase();
					var call = obj.results[i].url;
					// Get picture from id
					var num = call.substring(44);
					num = num.replace(/\//, '');
					var pic = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/" + num + ".png";
					if(num > 151) continue;
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
					titleText.innerHTML = num + ". " + name;
					// button
					var button = document.createElement("button");
					button.className = "btn btn-outline-light";
					button.innerHTML = "Get Info";
					button.type = "button";
					button.value = call;
					button.onclick = function() {
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
				document.querySelector("#first").onclick = function() { ajax("http://pokeapi.salestock.net/api/v2/pokemon/?limit=20&offset=0"); };
				if(obj.previous){
					document.querySelector("#previous").onclick = function() { ajax(obj.previous); };
				} else { document.querySelector("#previous").onclick = null; }
				if(obj.next != "http://pokeapi.salestock.net/api/v2/pokemon/?limit=20&offset=160"){
					document.querySelector("#next").onclick = function() { ajax(obj.next); };
				} else { document.querySelector("#next").onclick = null; }
				document.querySelector("#last").onclick = function() { ajax("http://pokeapi.salestock.net/api/v2/pokemon/?limit=20&offset=140"); };
			} else {
				// Getting needed information
				var profile = obj.sprites.front_default; 
				var name = obj.name.toUpperCase();
				var id = obj.id;
				var type1 = (obj.types[0]) ? obj.types[0].type.name.toUpperCase() : "null";
				var type2 = (obj.types[1]) ? obj.types[1].type.name.toUpperCase() : "null";
				var weight = obj.weight;
				if( (id != 303) && ((id > 151) || (id < 1)) ){
					profile = "_images/missingno.gif";
					name = "MISSINGNO";
					id = 0;
					type1 = "#@$!#";
					type2 = "%$*&$";
					weight = "-1";
				}
				if(id == 303){
					profile = "_images/nayeon.jpg";
					name = "NAYEON";
					id = 303;
					type1 = "JAVASCRIPT";
					type2 = "HTML";
					weight = "A+";
				}
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
				var typeText = document.createElement("p");
				typeText.innerHTML = (type1 == "null") ? ("none") : ( (type2 == "null") ? ("Type: " + type1) : ("Types: " + type1 + ", " + type2) );
				var weightText = document.createElement("p");
				weightText.innerHTML = "Weight: " + weight;
				// Appending children
				poke.appendChild(titleText);
				poke.appendChild(poster);
				poke.appendChild(typeText);
				poke.appendChild(weightText);
				// Adding to pokeList
				pokeList.appendChild(poke);
				// Add description
				var statText = document.createElement("div");
				statText.className = "card poke";
				var stats = obj.stats;
				var header = document.createElement("p");
				header.className = "card-header";
				header.innerHTML = "STATS:";
				statText.appendChild(header);
				for(var j = 0; j < stats.length; ++j){
					var stat = document.createElement("p");
					stat.innerHTML = stats[j].stat.name.toUpperCase() + ": " + stats[j].base_stat;
					statText.appendChild(stat);
				}
				pokeList.appendChild(statText);
				// Pagination
				document.querySelector("#first").onclick = function() { ajax("http://pokeapi.salestock.net/api/v2/pokemon/1"); };
				if(id > 1){
					document.querySelector("#previous").onclick = function() { ajax("http://pokeapi.salestock.net/api/v2/pokemon/" + (id-1)); };
				} else { document.querySelector("#previous").onclick = null; }
				if(id < 151){ 
					document.querySelector("#next").onclick = function() { ajax("http://pokeapi.salestock.net/api/v2/pokemon/" + (id+1)); };
				} else { document.querySelector("#next").onclick = null; }
				document.querySelector("#last").onclick = function() { ajax("http://pokeapi.salestock.net/api/v2/pokemon/151"); };
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
						pokeSubmit(JSON.parse(xhr.responseText));
					} else {
						document.querySelector("#loading-pic img").src = "_images/loadingcomplete.jpg";
						console.log("Oh no! A snorlax was blocking that search. Try a different search value!");
						placeSnorlax();
					}
				}
			}
		}
		// Submit action
		document.querySelector("#search-form").onsubmit = function() {
			var input = document.querySelector("#search-input").value.trim();
			document.querySelector("#search-input").value = "";
			var url = (input=="") ? "http://pokeapi.salestock.net/api/v2/pokemon/?limit=20&offset=0" : ("http://pokeapi.salestock.net/api/v2/pokemon/" + input);
			ajax(url);
			return false;
		}
		// Clear search bar
		document.querySelector("#search-input").onclick = function() {
			this.value = "";
		}
	</script>
	<script>ajax("http://pokeapi.salestock.net/api/v2/pokemon/?limit=20&offset=0")</script>
</body>
</html>
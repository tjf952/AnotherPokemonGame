<?php
	require 'config/config.php';
	session_start();
	// Check if user is logged in
	if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ) {
		// DB Connection
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}
		$mysqli->set_charset('utf8');
		// Item Dropdown
		$sql = "SELECT * FROM items WHERE iduser = " . $_SESSION['iduser'] . " ORDER BY item_id ASC;";
		$results = $mysqli->query($sql);
		if ( !$results ) {
			echo $mysqli->error;
			exit();
		}
		// Captures
		$sql_captures = "SELECT * FROM captures WHERE iduser = " . $_SESSION['iduser'] . " ORDER BY pokemon_id ASC;";
		$results_captures = $mysqli->query($sql_captures);
		if ( $results_captures == false ) {
			echo $mysqli->error;
			exit();
		}
		// Items
		$sql_items = "SELECT * FROM items WHERE iduser = " . $_SESSION['iduser'] . " ORDER BY item_id ASC;";
		$results_items = $mysqli->query($sql_items);
		if ( $results_items == false ) {
			echo $mysqli->error;
			exit();
		}
		// Close DB Connection
		$mysqli->close();
	} else {
		// Not logged in
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Trainer</title>
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
			margin: 0 auto;
		}
		header, footer {
			background-color: #262728;
			font-size: 16px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.search-button {
			font-weight: bold;
			background-color: #008cba;
			color: white;
			border-radius: 40%;
			transition: 0.4s;
		}
		.search-button:hover {
			background-color: white;
			color: black;
			border: 2px solid #008cba;
		}
	</style>
</head>
<body>
	<header>
		<div class="container">
		    <nav class="main nav">
		    	<img class="float-left" src="_images/mew3.jpg" alt = "Mew0" style="height: 50px;"/>
				<a class="nav-link" href="index.php">Pok&eacute;dex</a>
				<a class="nav-link" href="items.php">Items</a>
				<a class="nav-link active" href="about.php">About</a>
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
				<h2>Trainer Page</h2>
				<p>
					This is your profile page that contains your captured pok&eacute;mon, your favorited pok&eacute;mon, and your items. It is also where you can collect items and try catching new pok&eacute;mon.
				</p>
			</div>
		</div>

		<!-- SEARCH & HUNT -->
		<div class="row mt-4">
			<div class="col-12">
				<h2>Search and Hunt</h2>
				<table class="table" style="font-size: 20px;">
					<thead>
						<tr>
							<th scope="col">Item Search!</th>
							<th scope="col">Pok&eacute;mon Hunt!</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								Get a random item!<br><br>
								<button type="button" id="search" class="search-button">Search!</button><br><br>
								<div id="loading-pic-search">
									<img class="rounded-circle" src="_images/loadingcomplete.jpg" alt="Loading" style="height: 50px;"/>
								</div>
							</td>
							<td>
								Choose your item:<br><br>
								<select name="item" id="item-select" class="btn btn-secondary">
									<?php while ( $row = $results->fetch_assoc() ) : ?>
										<option value="<?php echo $row['item_id']; ?>">
											<?php echo $row['item_name']; ?>
										</option>
									<?php endwhile; ?>
								</select><br><br>
								<button type="button" id="hunt" class="search-button">Hunt!</button><br><br>
								<div id="loading-pic-hunt">
									<img class="rounded-circle" src="_images/loadingcomplete.jpg" alt="Loading" style="height: 50px;"/>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- CAPTURES TABLE -->
		<div class="row mt-4">
			<div class="col-12">
				<h2>My Pok&eacute;mon</h2>
				<table class="table table-hover table-dark">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Sprite</th>
							<th scope="col">Name</th>
							<th scope="col">Release</th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $row = $results_captures->fetch_assoc() ) : ?>
							<tr>
								<th scope="row"><?php echo $row['pokemon_id']; ?></th>
								<td>
									<img src=<?php echo $row['pokemon_image']; ?> alt =<?php echo $row['pokemon_id']; ?> />
								</td>
								<td><?php echo strtoupper($row['pokemon_name']); ?></td>
								<td>
									<a href="delete.php?idcapture=<?php echo $row['idcapture']; ?>&pokemon_id=<?php echo $row['pokemon_id']; ?>&pokemon_name=<?php echo $row['pokemon_name']; ?>" class="btn btn-outline-danger" onclick="return confirm('You are about to delete <?php echo $row['pokemon_name']; ?>.');">
										Release
									</a>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- ITEMS TABLE -->
		<div class="row mt-4">
			<div class="col-12">
				<h2>My Items</h2>
				<table class="table table-hover table-dark">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Sprite</th>
							<th scope="col">Name</th>
							<th scope="col">Count</th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $row = $results_items->fetch_assoc() ) : ?>
							<tr>
								<th scope="row"><?php echo $row['item_id']; ?></th>
								<td>
									<img src=<?php echo $row['item_image']; ?> alt = "<?php echo $row['item_id']; ?>"/>
								</td>
								<td><?php echo strtoupper($row['item_name']); ?></td>
								<td><?php echo $row['item_count']; ?></td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div> <!-- .container -->

	<hr><footer>
		<p style="color:white"> A website designed by Thomas Finn </p>
		<a href="#">Back to Top</a>
	</footer>

	<!-- JS -->
	<script type="text/javascript">
		// Button clicks
		document.querySelector("#search").onclick = function() {
			var r1 = Math.floor(Math.random()*16)+1;
			ajax(("http://pokeapi.salestock.net/api/v2/item/" + r1), true);
		}
		document.querySelector("#hunt").onclick = function() {
			var select = document.getElementById("item-select");
			if(select.selectedIndex == -1){
				return confirm('Oak\'s words echoed... It\'s too dangerous to go searching for pok\xE9mon without pok\xE9balls! First search for an item.');
			} else {
				var r2 = Math.floor(Math.random()*151)+1;
				ajax(("http://pokeapi.salestock.net/api/v2/pokemon/" + r2), false);
			}
		}
		// AJAX function
		function ajax(url, bool){
			var load = (bool == 1) ? "#loading-pic-search img" : "#loading-pic-hunt img";
			document.querySelector(load).src = "_images/loading.gif";
			console.log("Performing AJAX");
			var xhr = new XMLHttpRequest();
			xhr.open('GET', url);
			xhr.send();
			xhr.onreadystatechange = function() {
				if(xhr.readyState == XMLHttpRequest.DONE) {
					console.log(xhr.readyState);
					if(xhr.status == 200){
						document.querySelector(load).src = "_images/loadingcomplete.jpg";
						requestSubmit(JSON.parse(xhr.responseText), bool);
					} else {
						console.log("Oh no! A gyrados ate your action!");
					}
				}
			}
		}
		// Callback function
		function requestSubmit(obj, bool) {
			console.log("Calling back");
			console.log(obj);
				if(bool){
					var item_id = obj.id;
					var item_name = obj.name;
					var item_image = obj.sprites.default;
					// Send to confirmation page
					<?php
						$_SESSION['search_bool'] = true;
					?>
					var url = "search.php?item_id="+item_id+"&item_name="+item_name+"&item_image="+item_image;
					window.location = url;
				} else {
					var base = obj.base_experience;
					var pokemon_id = obj.id;
					var pokemon_name = obj.name;
					var pokemon_image = obj.sprites.front_default;
					// Get pokeball
					var select = document.getElementById("item-select");
					var item_id = select.options[select.selectedIndex].value;
					var item_name = select.options[select.selectedIndex].text;
					// Determine pokeball multiplier
					var ball;
					switch(parseInt(item_id)){
						case 1:
							ball = 255;
							break;
						case 2:
							ball = 2;
							break;
						case 3:
							ball = 1.5;
							break;
						case 4:
							ball = 1;
							break;
						default:
							ball = 1.25;
					} 
					// Calculates if caught or not
					var val = Math.floor((35/base)*100)*ball;
					var r3 = Math.floor(Math.random()*100)+1;
					var catchPoke = (r3 < val) ? true : false;
					// Send to confirmation page
					<?php
						$_SESSION['hunt_bool'] = true;
					?>
					var url = "hunt.php?pokemon_id="+pokemon_id+"&pokemon_name="+pokemon_name+"&pokemon_image="+pokemon_image+"&success="+catchPoke+"&item_id="+item_id+"&item_name="+item_name;
					window.location = url;
				}
		}
	</script>
</body>
</html>
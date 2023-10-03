<?php
	require 'config/config.php';
	session_start();

	if ( !isset($_SESSION['hunt_bool']) || !$_SESSION['hunt_bool']
		|| !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
		$error = "Oh no! A tentacruel attacked the city due to an invalid redirect or user credentials!";
	} else {
		if( isset($_GET['pokemon_id']) && !empty($_GET['pokemon_id']) 
			&& isset($_GET['pokemon_name']) && !empty($_GET['pokemon_name'])
			&& isset($_GET['pokemon_image']) && !empty($_GET['pokemon_image'])
			&& isset($_GET['success']) && !empty($_GET['success'])
			&& isset($_GET['item_id']) && !empty($_GET['item_id'])
			&& isset($_GET['item_name']) && !empty($_GET['item_name']) ){
			// Reset bool
			$_SESSION['hunt_bool'] = false;
			// Setting get variables
			$pokemon_id = $_GET['pokemon_id'];
			$pokemon_name = $_GET['pokemon_name'];
			$pokemon_image = $_GET['pokemon_image'];
			$caught = $_GET['success'];
			$item_id = $_GET['item_id'];
			$item_name = $_GET['item_name'];
			// Session variables
			$iduser = $_SESSION['iduser'];
			$username = $_SESSION['username'];
			// DB Connection
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if ( $mysqli->errno ) {
				echo $mysqli->error;
				exit();
			}
			$mysqli->set_charset('utf8');
			// Gets item count
			$sql_check = "SELECT * FROM items WHERE iduser = " 
					. $iduser . " AND item_id = " 
					. $item_id . ";"; 
			$results_check = $mysqli->query($sql_check);
			if ( !$results_check ) {
				echo $mysqli->error;
				exit();
			}
			$row = $results_check->fetch_assoc();
			$iditem = $row['iditem'];
			$item_count = $row['item_count'];
			// Decides whether to update or delete item
			if($item_count > 1){
				// Updates
				$sql_update = "UPDATE items SET 
							item_count = (item_count-1)
							WHERE iditem = " . $iditem . ";";
				// SQL Query
				$results_update = $mysqli->query($sql_update);
				if ( !$results_update ) {
					echo $mysqli->error;
					exit();
				}
			} else {
				// Deletes
				$sql_delete = "DELETE FROM items
							WHERE iditem = " . $iditem . ";";
				// SQL Query
				$results_delete = $mysqli->query($sql_delete);
				if ( !$results_delete ) {
					echo $mysqli->error;
					exit();
				}
			}
			// Adds pokemon if caught
			if( $caught == "true" ){
				// Inserts
				$sql_insert = "INSERT INTO captures (pokemon_id, pokemon_name, pokemon_image, iduser)
					VALUES ("
					. $pokemon_id . ", '"
					. $pokemon_name . "', '"
					. $pokemon_image . "', "
					. $iduser . ");";
				// SQL Query
				$results_insert = $mysqli->query($sql_insert);
				if ( !$results_insert ) {
					echo $mysqli->error;
					exit();
				}
			}
			// Update success or fail
			if( $caught == "true" ){
				$success = strtoupper($username) . " used a " . $item_name . " and caught a " . $pokemon_name . "!";
			} else {
				$error = strtoupper($username) . " used a " . $item_name . " and failed to catch a " . $pokemon_name . "...";
			}
			// Close Connection
			$mysqli->close();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hunt Confirmation</title>
	<link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="icon" href="_images/pokeball.jpg">
	<style>
		body, html {
			font-family: "Caveat", cursive;
			color: white;
			text-align: center;
			background-color: black;
			margin-left: auto;
			margin-right: auto;
		}
		header, footer {
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
	</style>
</head>
<body>
	<header>
		<div class="container">
		    <nav class="main nav">
		    	<img class="float-left" src="_images/mew3.jpg" alt = "Mew0" style="height: 50px;"/>
				<a class="nav-link" href="index.php">Pok&eacute;dex</a>
				<a class="nav-link" href="items.php">Items</a>
				<a class="nav-link" href="about.php">About</a>
				<a class="nav-link" href="http://303.itpwebdev.com/~thomasjf/student_page.html">Student Page</a>
				<?php include 'config/in.php'; ?>
		    </nav>
		</div> <!-- .container -->
	</header>

	<div class="container">
		<div class="row mt-4">
			<div class="col-12 text-center">
				<h2>Hunt Confirmation</h2>
				<img src="_images/explore.jpg" alt = "hunt" style="width: 75%;"/><br><br>
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php elseif ( isset($success) && !empty($success) ) : ?>
					<div class="text-success"><?php echo $success; ?></div>
				<?php else : ?>
					<div class="text-danger">Oh no! A tentacruel attacked the city!</div>
				<?php endif; ?>
			</div>
		</div>
	</div> <!-- .container -->

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<button type="button" id="search-button">Back</button>
		</div> <!-- .col -->
	</div> <!-- .row -->

	<hr><footer>
		<p style="color:white"> A website designed by Thomas Finn </p>
		<a href="#">Back to Top</a>
	</footer>

	<!-- JS -->
	<script type="text/javascript">
		document.querySelector("#search-button").onclick = function() {
			window.location = "trainer.php";
		}
	</script>
</body>
</html>
<?php
	require 'config/config.php';
	session_start();
	if( isset($_GET['pokemon_id']) && !empty($_GET['pokemon_id']) 
		&& isset($_GET['pokemon_name']) && !empty($_GET['pokemon_name'])
		&& isset($_GET['idcapture']) && !empty($_GET['idcapture']) ){
		// Setting get variables
		$idcapture = $_GET['idcapture'];
		$pokemon_id = $_GET['pokemon_id'];
		$pokemon_name = $_GET['pokemon_name'];
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
		// Deletes
		$sql_delete = "DELETE FROM captures
					WHERE idcapture = " . $idcapture . ";";
		// SQL Query
		$results_delete = $mysqli->query($sql_delete);
		if ( !$results_delete ) {
			echo $mysqli->error;
			exit();
		}
		// Update success
		$success = strtoupper($username) . " said farewell to " . $pokemon_name . "!";
		// Close Connection
		$mysqli->close();
	} else {
		$error = "Oh no! A tentacruel attacked the city due to an invalid redirect or user credentials!";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Confirmation</title>
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
				<h2>Delete Confirmation</h2>
				<img src="_images/delete.gif" alt = "hunt" style="width: 75%;"/><br><br>
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
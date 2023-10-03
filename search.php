<?php
	require 'config/config.php';
	session_start();

	if ( !isset($_SESSION['search_bool']) || !$_SESSION['search_bool']
		|| !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
		$error = "Oh no! A tentacruel attacked the city due to an invalid redirect or user credentials!";
	} else {
		if( isset($_GET['item_id']) && !empty($_GET['item_id']) 
			&& isset($_GET['item_name']) && !empty($_GET['item_name'])
			&& isset($_GET['item_image']) && !empty($_GET['item_image']) ){
			// Reset bool and setting variables
			$_SESSION['search_bool'] = false;
			$item_id = $_GET['item_id'];
			$item_name = $_GET['item_name'];
			$item_image = $_GET['item_image'];
			$iduser = $_SESSION['iduser'];
			$username = $_SESSION['username'];
			// DB Connection
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if ( $mysqli->errno ) {
				echo $mysqli->error;
				exit();
			}
			$mysqli->set_charset('utf8');
			// Check if item is in database
			$sql_check = "SELECT * FROM items WHERE iduser = " 
					. $iduser . " AND item_id = " 
					. $item_id . ";"; 
			$results_check = $mysqli->query($sql_check);
			if ( !$results_check ) {
				echo $mysqli->error;
				exit();
			}
			// Decides whether to add or update
			if($results_check->num_rows){
				$row = $results_check->fetch_assoc();
				$iditem = $row['iditem'];
				// Updates
				$sql_update = "UPDATE items SET 
							item_count = (item_count+1)
							WHERE iditem = " . $iditem . ";";
				// SQL Query
				$results_update = $mysqli->query($sql_update);
				if ( !$results_update ) {
					echo $mysqli->error;
					exit();
				}
			} else {
				// Inserts
				$sql_insert = "INSERT INTO items(item_id, item_name, item_count, item_image, iduser)
					VALUES ("
					. $item_id . ", '"
					. $item_name . "', "
					. 1 . ", '"
					. $item_image . "', "
					. $iduser . ");";
				// SQL Query
				$results_insert = $mysqli->query($sql_insert);
				if ( !$results_insert ) {
					echo $mysqli->error;
					exit();
				}
			}
			// Update success
			$success = strtoupper($username) . " found 1 " . $item_name . "!";
			// Close Connection
			$mysqli->close();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Confirmation</title>
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
				<h2>Search Confirmation</h2>
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
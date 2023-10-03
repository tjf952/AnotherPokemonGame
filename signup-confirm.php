<?php
	require 'config/config.php';
	session_start();

	if ( !isset($_POST['email']) || empty($_POST['email'])
		|| !isset($_POST['username']) || empty($_POST['username'])
		|| !isset($_POST['password']) || empty($_POST['password']) 
		|| !isset($_POST['password-confirmation']) || empty($_POST['password-confirmation']) ) {
		$error = "Please fill out all required fields.";
	} else {
		// DB Connection
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->errno ) {
			echo $mysqli->error;
			exit();
		}
		$mysqli->set_charset('utf8');
		// Check if User Exists
		$sql_reg = "SELECT * FROM users
					WHERE username = '" . $_POST['username'] . "'
					OR email = '" . $_POST['email'] . "';";
		$results_reg = $mysqli->query($sql_reg);
		$password = hash('sha256', $_POST['password']);
		if(!$results_reg->num_rows){
			// SQL Statement
			$sql = "INSERT INTO users(username, email, password) VALUES ('"
				. $_POST['username'] . "', '"
				. $_POST['email'] . "', '"
				. $password . "');"; 
			// SQL Query
			$results = $mysqli->query($sql);
			if(!$results){
				echo $results->error;
				exit();
			}
		} else {
			$error = "Username or email already exists.";
		}
		// Close Connection
		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Confirmation</title>
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
		    </nav>
		</div> <!-- .container -->
	</header>

	<div class="container">
		<div class="row mt-4">
			<div class="col-12 text-center">
				<h2>Trainer Sign Up Confirmation</h2>
				<img src="_images/bg3.jpg" alt = "Starters2" style="width: 100%;"/><br><br>
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['username']; ?> was successfully registered.</div>
				<?php endif; ?>
			</div>
		</div>
	</div> <!-- .container -->

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<a href="login.php" role="button" class="btn btn-primary">Login</a>
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Back</a>
		</div> <!-- .col -->
	</div> <!-- .row -->

	<hr><footer>
		<p style="color:white"> A website designed by Thomas Finn </p>
		<a href="#">Back to Top</a>
	</footer>
</body>
</html>
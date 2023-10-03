<?php
	require 'config/config.php';
	session_start();
	// Check if user is logged in
	if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
		// User not logged in and check if form submitted
		if ( isset($_POST['username']) && isset($_POST['password']) ) {
			// Check if username and password entered
			if ( empty($_POST['username']) || empty($_POST['password']) ) {
				$error = "Please enter username and password.";
			} else {
				// If entered, checks if valid credentials
				// DB Connection
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				if ( $mysqli->errno ) {
					echo $mysqli->error;
					exit();
				}
				$mysqli->set_charset('utf8');
				// Check if User Exists
				$sql_reg = "SELECT * FROM users
							WHERE username = '" . $_POST['username'] . "';";
				$results = $mysqli->query($sql_reg);
				if ( !$results ) {
					echo $mysqli->error;
					exit();
				}
				$password = hash('sha256', $_POST['password']);
				if($results->num_rows){
					// Check password
					$result = $results->fetch_assoc();
					$correct_password = $result['password'];
					// echo "PASSWORD: " . $password . " | CHECK: " . $correct_password;
					if($password == $correct_password){
						// Logs user in
						$_SESSION['logged_in'] = true;
						$_SESSION['iduser'] = $result['iduser'];
						$_SESSION['username'] = $result['username'];
						header('Location: trainer.php');
					} else {
						$error = "Invalid password.";
					}			
				} else {
					$error = "Invalid username.";
				}
				// Close Connection
				$mysqli->close();
			} 
		}
	} else {
		// User Already Logged In.
		header('Location: trainer.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="icon" href="_images/pokeball.jpg">
	<style>
		body, html {
			font-family: "Caveat", cursive;
			text-align: center;
			color: white;
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
				<h2>Trainer Login</h2>
				<img src="_images/bg1.jpg" alt = "Starters1" style="width: 100%;"/>
				<form action="login.php" method="POST">
					<div class="row mb-3">
						<div class="font-italic text-danger col-sm-9 ml-sm-auto">
							<?php if ( isset($error) && !empty($error) ) { echo $error; } ?>
						</div>
					</div> <!-- .row -->
					<div class="form-group row">
						<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="username-id" name="username" placeholder="Username">
						</div>
					</div> <!-- .form-group -->
					<div class="form-group row">
						<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="password-id" name="password" placeholder="Password">
						</div>
					</div> <!-- .form-group -->
					<div class="form-group row">
						<div class="col-sm-9 ml-sm-auto">
							<button type="submit" id="search-button">Login</button>
							<a href="signup.php">Sign up here</a>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div> <!-- .container -->

	<hr><footer>
		<p style="color:white"> A website designed by Thomas Finn </p>
		<a href="#">Back to Top</a>
	</footer>
</body>
</html>
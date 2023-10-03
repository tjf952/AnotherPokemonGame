<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
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
				<h2>Trainer Sign Up</h2>
				<img src="_images/banner.png" alt = "Starters2" style="width: 100%;"/><br><br>
				<form action="signup-confirm.php" method="post">
					<div class="form-group row">
						<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username: <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="username-id" name="username" placeholder="Username">
							<small id="username-error" class="invalid-feedback">Username is required.</small>
						</div>
					</div> <!-- .form-group -->
					<div class="form-group row">
						<label for="email-id" class="col-sm-3 col-form-label text-sm-right">Email: <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="email-id" name="email" placeholder="Email">
							<small id="email-error" class="invalid-feedback">Email is required.</small>
						</div>
					</div> <!-- .form-group -->	
					<div class="form-group row">
						<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password: <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="password-id" name="password" placeholder="Password">
							<small id="password-error" class="invalid-feedback">Password is required.</small>
						</div>
					</div> <!-- .form-group -->
					<div class="form-group row">
						<label for="password-confirmation-id" class="col-sm-3 col-form-label text-sm-right">Confirm Pass: <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="password-confirmation-id" name="password-confirmation" placeholder="Confirm Password">
							<small id="password-error" class="invalid-feedback">Must be the same as password field.</small>
						</div>
					</div> <!-- .form-group -->
					<div class="row">
						<div class="ml-auto col-sm-9">
							<span class="text-danger font-italic">* Required</span>
						</div>
					</div> <!-- .form-group -->
					<div class="form-group row">
						<div class="col-sm-3"></div>
						<div class="col-sm-9 mt-3">
							<button type="submit" id="search-button">Sign-up</button>
						</div>
					</div> <!-- .form-group -->
					<div class="row">
						<div class="col-sm-9 ml-sm-auto">
							<a href="login.php">Already have an account</a>
						</div>
					</div> <!-- .row -->
				</form>
			</div>
		</div>
	</div> <!-- .container -->

	<hr><footer>
		<p style="color:white"> A website designed by Thomas Finn </p>
		<a href="#">Back to Top</a>
	</footer>

	<!-- JS -->
	<script>
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#username-id').value.trim().length == 0 ) {
				document.querySelector('#username-id').classList.add('is-invalid');
			} else {
				document.querySelector('#username-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#email-id').value.trim().length == 0 ) {
				document.querySelector('#email-id').classList.add('is-invalid');
			} else {
				document.querySelector('#email-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password-id').value.trim().length == 0 ) {
				document.querySelector('#password-id').classList.add('is-invalid');
			} else {
				document.querySelector('#password-id').classList.remove('is-invalid');
			}

			if ( (document.querySelector('#password-confirmation-id').value.trim().length == 0) || (document.querySelector('#password-confirmation-id').value.trim() != document.querySelector('#password-id').value.trim()) ) {
				document.querySelector('#password-confirmation-id').classList.add('is-invalid');
			} else {
				document.querySelector('#password-confirmation-id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>
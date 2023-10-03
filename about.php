<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Project Proposal</title>
	<link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="icon" href="_images/pokeball.jpg">
	<style>
		body {
			background-image: linear-gradient(lavender, rgb(100,158,216));
			font-family: "Caveat", cursive;
			text-align: center;
		}
		header, footer {
			color: white;
			background-color: #262728;
			font-size: 16px;
			padding-top: 10px;
			padding-bottom: 10px;
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
				<a class="nav-link">About</a>
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
				<h2>Topic</h2>
				<p>
					Basically this website is a fun interactive Pok&eacute;mon themed website much like the games or the Silph Road website where users can search through the pok&eacute;dex of the original 151 pok&eacute;mon and have their own profiles. The profiles will involve an array of activities:
				</p>
				<ol>
					<li>Ability to all users to view pok&eacute;dex and in-game items</li>
					<li>Ability for members to view and release current pok&eacute;mon</li>
					<li>Ability for members to conduct a <i>search</i> for items</li>
					<li>Ability for members to conduct a <i>hunt</i> for pok&eacute;mon that uses my catch algoritm</li>
					<li>A login/logout and signup system that stores data in a back-end database.</li>
				</ol>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<h2>Audience</h2>
				<p>
					Anyone interested in the Pok&eacute;mon games or once had dreams of becoming a Pok&eacute;mon master but grew up too fast. Young and old alike can quickly create an account and try to catch them all.
				</p>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<h2>Design &amp; Style</h2>
				<h4>Design and Color Scheme</h4>
				<p>
					The design draws from learning how to use bootstrap and has pages that are appealing to the eye. Most pages have a variety of pictures and aesthetic fonts. The color scheme will be similar to the profile page of silphroad, but follow a more modern look with tones of gray and light blue.
				</p>
				<h4>Links to 3 Inspiring Websites</h4>
				<ul>
					<li> <a href="https://www.pokemon.com/us/" target="blank">Official Pok&eacute;mon Website</a> </li>
					<li> <a href="https://thesilphroad.com/" target="blank">Silph Road Website</a> </li>
					<li> <a href="https://www.serebii.net/" target="blank">Serebii Website</a> </li>
				</ul>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<h2>Scope</h2>
				<h4>Pagination?</h4>
				<p>
					This website has many pages that allow for user interaction that will take advantage of javascript and php functionality:
				</p>
				<ul>
					<li><strong>Homepage:</strong> This is the page that a user is directed to upon in initial entry of the website. The page consists of the first page of the Pok&eacute;dex.</li>
					<li><strong>Pok&eacute;dex:</strong> This page contains the pok&eacute;dex with pagination. There's two view types, the general view and the detailed view. Each comes with unique pagination and information. The general view allows you to see basic information about 20 pok&eacute;mon while the detailed view allows you to see information and statistics about only one pok&eacute;mon</li>
					<li><strong>Items Page:</strong> A list of possible items. This page also has two view types, the general viewl and the detailed view.</li>
					<li><strong>Trainer Login:</strong> This will be a page where trainers can log into their account. If there is a successful login, then it will lead to a trainer page. This page uses php to initialize session variables and retrieve information from the back-end database.</li>
					<li><strong>Trainer Signup:</strong> This will allow new users to signup. They will be greeted with a confirmation page if it is successful. To sign-up, it will insert into the user information into the back-end database.</li>
					<li><strong>Trainer Page:</strong> A trainer page with current pok&eacute;mon and items in bag displayed by retrieval from the back-end database. It also has two special sections, one for searching for items and the other for hunting for pok&eacute;mon. The search section allows members to search and receive one item. The hunt section allows members to pick an item that they own to use in a hunt for a pok&eacute;mon. Depending on the results of an in code algorithm, it will either succeed or fail in capture while always decrementing the item chosen count.</li>
					<li><strong>Hunt/Search/Delete Page:</strong> Confirmation page that will either confirm search/hunt/delete or state an error. Each confirmation page does queries on the back-end database to either insert, update, or delete one of the tables.</li>
					<li><strong>About Page:</strong> This current page. It includes the project summary and contents as well as breif insight on each page. It gives summaries on both the use of an API and the existence of a back-end database as well as extras in sections below.</li>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<h2>Database</h2>
				<h4>Database Data?</h4>
				<p>
					Database data will be focused on user information. It will contain their username, password, pok&eacute;mon captured list, and items list. It is stored in three tables which are 'users', 'captures', and 'items'. The identifier 'iduser' is used to keep unique information to each user.
				</p>
				<h4>Data Origins?</h4>
				<p>
					Data will originate from orginal login input and from updates made by user interaction. The following CRUD functionality is as below:
				</p>
				<ul>
					<li><strong>Create:</strong> When signing-up or gaining pok&eacute;mon or items on a profile.</li>
					<li><strong>Read:</strong> When signing-in or opening the trainer page.</li>
					<li><strong>Update:</strong> When gaining or using items.</li>
					<li><strong>Delete:</strong> When releasing a pok&eacute;mon or decrementing item count to 0.</li>
				</ul>
				<h4><a href="_images/db_project.jpg" target = "blank">Click here for Database Diagram</a></h4>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<h2>Extras</h2>
				<h4><a href="https://pokeapi.co/" target = "blank">Pok&eacute;API</a></h4>
				<p>
					This project relied heavily on the use of the API 'Pok&eacute;API'. I used ajax through javascript to fetch data objects from the online API and then converted it to a JSON object to be used for display of information in the 'Pok&eacute;dex' page and the 'Item' page. 
				</p>
				<h4><a href="https://pokeapi.co/docsv2/" target = "blank">Click here for Pok&eacute;API Documentation</a></h4>
			</div>
			<div class="col-12">
				<h4>Included in this project is:</h4>
				<ul>
					<li>Pagination</li>
					<li>Sessions</li>
					<li>Different User Permissions</li>
					<li>JSON API with Frontend AJAX</li>
					<li>Intuitive User Interface</li>
					<li>Responsive Web Design</li>
				</ul>
			</div>
		</div>
	</div> <!-- .container -->

	<hr><footer>
		<p style="color:white"> A website designed by Thomas Finn </p>
		<a href="#">Back to Top</a>
	</footer>

</body>
</html>
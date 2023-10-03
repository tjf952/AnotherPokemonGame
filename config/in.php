<?php if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) : ?>
	<a class="nav-link text-center p-2 ml-auto" href="login.php">Trainer Login</a>
<?php else : ?>
	<a class="nav-link" href="trainer.php"> <?php echo strtoupper($_SESSION['username']); ?> </a>
	<a class="nav-link text-center p-2 ml-auto" href="logout.php">Logout</a>
<?php endif; ?>
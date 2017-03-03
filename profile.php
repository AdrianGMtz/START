<!DOCTYPE html>
<html>
	<head>
		<title>START! | username</title>
		<?php include('header.html'); ?>
	</head>

	<body>
		<!--Top navigation bar-->
		<?php include('navbar.php'); ?>

		<br><br>

	<div class="container">
		<div class="row">
			<!-- User info bar -->
			<div class="card-panel col s12 m4 l3 grey lighten-4">
				<img class="responsive-img " src="images/user.png">
				<div id="username" class="center">
					<h5>Username</h5>
				</div>

				<div id="description">
					<p>All user information and personalized description will go here.</p>
					<div class="center">
						<a class="waves-effect waves-light btn blue">Message</a>
					</div>
					<br>
				</div>
			</div>

			<!-- Commissions area. Empty version for non-artists -->
			<!--
			<div class="col s12 m8 l9">
				<div class="card-panel blue lighten-5 card-content valign center">
					<h5 class="blue-text text-lighten-2">You must be an artist to offer commissions.</h5>
					<br>
					<a class="waves-effect waves-light btn blue">Become an artist</a>
				</div> 
			</div>
			-->

			 <!-- Commissions area for artist (Only the last one or this one will be shown) -->
			<div class="col s12 m8 l9">
				<div class="card-panel blue lighten-5 card-content valign center">
					<h5 class="blue-text text-lighten-2">You're not offering any commissions.</h5>
					<br>
					<a class="waves-effect waves-light btn blue">Add commission</a>
				</div> 
			</div>
		</div>
		<br>
	</div>
	</body>
	<!--Footer-->
	<?php include('footer.html'); ?>
</html>
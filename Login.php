<?php
	session_start(); //start a session to save user info

	// If you receive something from the submit button
	if($_POST['submit']) {

		include_once("Connect.php"); // connect to database

		// clean up user input
		$email = strip_tags($_POST['email']);
		$password = strip_tags($_POST['password']);

		// Create the query and send it to the database
		$sql = "SELECT userID, email, passwrd FROM users WHERE email = '$email' LIMIT 1 ";
		$query = mysqli_query($db,$sql);

		// Save what it returns in query and access it, save it in those variables
		if ($query) {
			$row = mysqli_fetch_row($query);
			$userID = $row[0];	// 0 is the first column in the table, the id.
			$dbEmail = $row[1];
			$dbPassword = $row[2];
		}

		// If what the user sent and what the database returned are the same...
		if($email == $dbEmail && $password == $dbPassword) {

			// Add them to the session
			$_SESSION['email'] = $email;
			$_SESSION['userID'] = $userID;
			
			header('location: profile.html'); // Send the user to the profile page

		} else {
			// Show error pop-up
			echo "<script type='text/javascript'>alert('Incorrect email or password');</script>";
		}
	}

?>
<!DOCTYPE html>
	<head>
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"	media="screen,projection"/>

		<!--Import style.css-->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<title>START! | Login</title>

		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
	</head>

	<body>
		<!--Top navigation bar-->
		<nav>
			<div class="nav-wrapper black">
				<a href="index.html" class="brand-logo"> START! </a>
				<ul id="nav-mobile" class="right"> <!-- The navigation links are aligned to the right -->
					<li><a href="signup.html"> Sign Up </a></li>
					<li><a href="login.php"> Login </a></li>
				</ul>
			</div>
		</nav>

		<!-- Sign Up form -->
		<br>
		<div class="container">
			<div class="row">
				<div class="card-panel col s12 m6 grey lighten-4 center offset-m3">
					<br>
					<form class="col s12 m6 offset-m3 " action = "Login.php" method = "post">

						<div id="username" class="center">
							<h5>Log In</h5>
						</div>

						<!-- Email -->
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">email</i>
								<input id="email" type="text" class="validate" name="email">
								<label for="email">	<b>Email</b>	</label>
							</div>
						</div>

						<!-- Password -->
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input id="password" type="password" class="validate" name="password">
								<label for="password"> <b>Password</b> </label>
							</div>
						</div>

						<!-- Submit button -->
						<div class="center">
							<button class=" btn-large waves-effect waves-light center" type="submit" name="submit" value = "Log In"> <b>Login</b>
							<i class="material-icons right">send</i>
							</button>
						</div>
						<br>
					</form>
					<br>
				</div>
			</div>
		</div>
	</body>
	<!--Footer-->
	<footer class="page-footer black">
		<div class="footer-copyright">
			<div class="container">
				© 2017 START. All rights reserved
				<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
			</div>
		</div>
	</footer>
</html>
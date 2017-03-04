<!DOCTYPE html>
<html>
	<head>
		<title>START! | Sign Up</title>
		<?php include('header.html'); ?>
	</head>

	<body>
		<!--Top navigation bar-->
		<?php include('navbar.php'); ?>

		<!-- Sign Up form -->
		<br>
		<div class="container">
			<div class="row">
				<div class="card-panel col s12 m6 grey lighten-4 center offset-m3">
					<form class="col s12 m6 offset-m3">
						<h5>Sign Up</h5>

						<!-- Username -->
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">person</i>
								<input id="username" type="text" class="validate">
								<label>	<b>Username</b>	</label>
							</div>
						</div>

						<!-- Email -->
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">email</i>
								<input id="email" type="email" class="validate">
								<label data-error="Please enter a valid email address"> <b>Email</b> </label>
							</div>
						</div>

						<!-- Password -->
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input id="password" type="password" class="validate">
								<label> <b>Password</b> </label>
							</div>
						</div>

						<!-- Submit button -->
						<a class="waves-effect waves-light btn" id="signup" style="margin-bottom: 20px;"><i class="material-icons right">send</i><b>Join START</b></a>
						</div>
					</form>
				</div>
			</div>
		</div>

	</body>
	<!--Footer-->
	<?php include('footer.html'); ?>
</html>
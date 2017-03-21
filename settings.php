<!DOCTYPE html>
<html>
	<head>
		<title>START! | Settings</title>
		<?php include('header.html'); ?>
		<!--Import scripts.js-->
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>

	<body>
		<!--Top navigation bar-->
		<?php include('navbar.php'); ?>

		<!-- Settings form -->
		<br>
		<div class="container">
			<div class="row">
				<div class="card-panel col s12 m6 grey lighten-4 center offset-m3">
					<form class="col s12 m6 offset-m3">
						<h5>Settings</h5>

						<!-- Email -->
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">email</i>
								<input id="email" type="email" class="validate">
								<label data-error="Please enter a valid email address"> <b>Email</b> </label>
							</div>
						</div>

						<!-- Old Password -->
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input id="oldPass" type="password" class="validate">
								<label> <b>Old Password</b> </label>
							</div>
						</div>

						<!-- New Password -->
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input id="newPass" type="password" class="validate">
								<label> <b>New Password</b> </label>
							</div>
						</div>

						<!-- Repeat New Password -->
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input id="newPass2" type="password" class="validate">
								<label> <b>Repeat New Password</b> </label>
							</div>
						</div>

						<!-- Save button -->
						<a class="waves-effect waves-light btn" id="changePassword" style="margin-bottom: 20px;"><i class="material-icons right">send</i><b>Save</b></a>
					</form>
					<br>
				</div>
			</div>
		</div>

	</body>
	<!--Footer-->
	<?php include('footer.html'); ?>
</html>

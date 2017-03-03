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
		<script type="text/javascript">
			$(document).ready(function(){
				$("#signup").click(function(){
					if ($('#username').val() != "" && $('#email').val() != "" && $('#password').val() != ""){
						var jsonObject = {
							"action": "REGISTRATION",
							"username": $('#username').val(),
							"email": $('#email').val(),
							"password": $('#password').val()
						};
						
						$.ajax({
							type:'POST',
							url:'data/applicationLayer.php',
							data: jsonObject,
							dataType:'json',
							headers:{'Content-Type':'application/x-www-form-urlencoded'},
							success: function(jsonData){
								//logged = true;
		                        //checkUserStatus();
		                        window.location.replace("profile.php");
								alert(jsonData.message);
							},
							error:function(errorMessage){
								alert("Error trying to register user!");
							}
						});  
					} else {
						alert("Complete all fields!");
					}
				});
			});
		</script>
	</body>
	<!--Footer-->
	<?php include('footer.html'); ?>
</html>
<!DOCTYPE html>
<html>
	<head>
		<title>START! | username</title>

		<?php include('header.html'); ?>

		<script type="text/javascript">
			$(document).ready(function(){
		      $('.slider').slider();
		      $('.modal').modal();
		    });
		</script>
	</head>

	<body>
		<!--Top navigation bar-->
		<?php include('navbar.php'); ?>

		<div class="container">

			<div class="row">
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


				<!-- Commission Details -->
				<div class="col s12 m8 l9">
					<div class="card-panel blue-grey darken-4 card-content valign center">
					<a class="waves-effect waves-light btn left blue"><i class="material-icons left">chevron_left</i>Back</a>
					<br>
					<h4 class="white-text">Sketch</h4> <br>
						
						<div class="slider">
							<ul class="slides">

							<li>						 
								<img src="images/user.png" class="materialboxed"> <!-- random image -->
								<div class="caption center-align">
								<h3>Optional title for the example</h3>
								</div>
							</li>

							<li>						 
								<img src="images/user.png" class="materialboxed"> <!-- random image -->
								<div class="caption center-align">
								<h3>Optional title for the example</h3>
								</div>
							</li>

							<li>						 
								<img src="images/user.png" class="materialboxed"> <!-- random image -->
								<div class="caption center-align">
								<h3>Optional title for the example</h3>
								</div>
							</li>

							</ul>

							<h5 class="right-align white-text">Price: $20</h5>
						</div>
						<br>
							<p class="white-text left">A short description about the specific commission type will be placed here.</p>

							<br><br><br>

						<a class="waves-effect waves-light btn orange btn-large " href="#policies">Commission artist</a>
					</div> 
				</div>
			</div>
		</div>
	</body>



	<!-- Modal Structure -->
	<div id="policies" class="modal">
		<div class="modal-content">
		<h4 class="center">Client Agreement</h4>
		<p><b> You agree to follow this artist's commission policies: </b></p>

		<ul>
			<li> No deadline </li>
			<li> At most 2 changes </li>
			<li> No refunds </li>
		</ul>

		</div>
		<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-orange btn-flat">I Agree</a>
		</div>
	</div>

	<!--Footer-->
	<?php include('footer.html'); ?>
</html>
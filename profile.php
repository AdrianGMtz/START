<!DOCTYPE html>
<html>
	<head>
		<title>START! | Profile</title>
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
				<!-- User Image -->
				<img class="responsive-img " src="images/user.png">
				
				<!-- User Name -->
				<h5 id="username" class="center"></h5>

				<!-- User Description -->
				<p id="description">All user information and personalized description will go here.</p>
				
				<!-- Profile Edit / Message Artist -->
				<div class="center">
					<a class="waves-effect waves-light btn blue artist">Message</a>
					<!-- Edit Modal Trigger -->
					<a class="modal-trigger waves-effect waves-light btn blue nonArtist" href="#editModal">Edit</a>
				</div>
				<br>
			</div>

			<!-- Modal Structure -->
			<div id="editModal" class="modal modal-fixed-footer">
				<div class="modal-content">
					<h4>Edit Description</h4>
					<input type="text" name="description" id="editDescription">
				</div>
				<div class="modal-footer">
					<button class="modal-action modal-close waves-effect waves-green btn-flat" id="saveBtn">Save</button>
					<button class="modal-action modal-close waves-effect waves-green btn-flat" id="cancelBtn">Cancel</button>
				</div>
			</div>

			<!-- Commissions area -->
			<div class="col s12 m8 l9">
				<h5 class="center">Commissions</h5>
				<!-- Message for non artists -->
				<div class="card-panel blue lighten-5 card-content valign center nonArtist">
					<h5 class="blue-text text-lighten-2">You must be an artist to offer commissions.</h5>
					<br>
					<a class="waves-effect waves-light btn blue">Become an artist</a>
				</div>

				<!-- Message for artist (Only the last one or this one will be shown) -->
				<div class="card-panel blue lighten-5 card-content valign center artist">
					<h5 class="blue-text text-lighten-2">You're not offering any commissions.</h5>
					<br>
					<a class="waves-effect waves-light btn blue">Add commission</a>
				</div>
			</div>
		</div>
		<br>
	</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
			// Used to check the state of the user
			var logged = false;
			var userID = '';
			var userEmail = '';

			// Verify if any session exists
			getUserInfo();

			// Check Session
			function getUserInfo() {
				$("#nav-mobile").empty();

				var jsonData = {
					"action" : "GETUSERINFO"
				};

				$.ajax({
					url : "data/applicationLayer.php",
					type : "POST",
					data : jsonData,
					dataType : "json",
					contentType : "application/x-www-form-urlencoded",
					success: function(jsonResponse){
						logged = true;
						userID = jsonResponse.ID;
						userEmail = jsonResponse.Email;
						description = jsonResponse.Description;

						$('#username').text(userID);
						$('#description').text(description);
						$('title').text('START! | ' + userID);
						$("#nav-mobile").html('<li><a href="profile.php">' + userID + '</a></li><li><a href=""><i class="material-icons left">email</i><span class="new badge red"> 1 </span></a></li><li id="logout" style="padding-right: 15px; padding-left: 15px;">Logout</li>');
						$('.artist').hide();
					},
					error : function(errorMessage){
						logged = false;
						window.location.replace("login.php");
					}
				});
				console.log(userID);
			}

			// Edit
			$('.modal').modal({
				dismissible: false,
				opacity: .5,
				inDuration: 250,
				outDuration: 250
			});
			// Save
			$("#saveBtn").click(function(){
				var description = $(editDescription).val();

				var jsonData = {
					"action" : "EDITINFO",
					"userEmail" : userEmail,
					"description" : description
				};

				$.ajax({
					url : "data/applicationLayer.php",
					type : "POST",
					data : jsonData,
					dataType : "json",
					contentType : "application/x-www-form-urlencoded",
					success: function(jsonResponse){
						console.log("saved");
						$(editDescription).val('');
					},
					error : function(errorMessage){
						console.log(errorMessage.responseText);
					}
				});
			});
			// Cancel
			$("#cancelBtn").click(function(){
				$(editDescription).val('');
			});
		});
	</script>
	<!--Footer-->
	<?php include('footer.html'); ?>
</html>
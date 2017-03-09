<!DOCTYPE html>
<html>
	<head>
		<title>START! | Profile</title>
		<?php include('header.html'); ?>
	</head>

	<body>
		<!--Top navigation bar-->
		<?php include('navbar.php'); ?>

		<br>

	<div class="container">
		<div class="row">
			<!-- User info bar -->
			<div class="card-panel col s12 m4 l3 grey lighten-4">
				<!-- User Image -->
				<img class="responsive-img " src="images/user.png">
				
				<!-- User Name -->
				<h5 id="username" class="center"></h5>

				<!-- User Description -->
				<p id="description"></p>
				
				<!-- Profile Edit / Message Artist -->
				<div class="center">
					<!-- Edit Modal Trigger -->
					<a class="modal-trigger waves-effect waves-light btn blue" href="#editModal">Edit</a>
					<a class="waves-effect waves-light btn blue artist">Message</a>
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
					<button class="modal-action modal-close waves-effect waves-light btn blue" id="saveBtn">Save</button>
					<button class="modal-action modal-close waves-effect waves-light btn blue" id="cancelBtn">Cancel</button>
				</div>
			</div>

			<!-- Commissions area -->
			<div class="col s12 m8 l9">
				<h5 class="center">Commissions</h5>
				<!-- Message for non artists -->
				<div class="card-panel blue lighten-5 card-content valign center nonArtist">
					<h5 class="blue-text text-lighten-2">You must be an artist to offer commissions.</h5>
					<br>
					<button class="modal-action modal-close waves-effect waves-light btn blue" id="becomeArtistBtn">Become an artist</button>
				</div>

				<!-- Message for artist (Only the last one or this one will be shown) -->
				<div class="card-panel blue lighten-5 card-content valign center artist">
					<h5 class="blue-text text-lighten-2">You're not offering any commissions.</h5>
					<br>
					<button class="modal-action modal-close waves-effect waves-light btn blue" id="addCommissionBtn">Add commission</button>
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

			// Get user info (Artist status, description, username, commissions)
			getUserInfo();

			function getUserInfo() {
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
						categories = jsonResponse.Categories;
						subcategories = jsonResponse.Subcategories;
						artist = jsonResponse.Artist;

						$('#username').text(userID);
						$('#description').text(description);
						$('#editDescription').val(description);
						$('title').text('START! | ' + userID);
						$("#userID").text(userID);
						$(".loggedIN").show();
						$(".loggedOUT").hide();
						if (artist == '1') {
							$('.nonArtist').hide();
							$('.artist').show();
						} else {
							$('.artist').hide();
							$('.nonArtist').show();
						}
					},
					error : function(errorMessage){
						logged = false;
						$(".loggedIN").hide();
						$(".loggedOUT").show();
						$("#userID").text("");
						window.location.replace("login.php");
					}
				});
			}

			// Edit description Modal
			$('.modal').modal({
				dismissible: false,
				opacity: .5,
				inDuration: 250,
				outDuration: 250
			});

			// Save description
			$("#saveBtn").click(function(){
				var description = $('#editDescription').val();

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
						$('#editDescription').val('');
						$('#description').text(description);
						alert('Description saved Successfully!');
					},
					error : function(errorMessage){
						console.log(errorMessage.responseText);
					}
				});
			});

			// Cancel Edit Description
			$("#cancelBtn").click(function(){
				$('#editDescription').val($('#description').text());
			});

			// Become Artist if user is not one
			$("#becomeArtistBtn").click(function(){
				var jsonData = {
					"action" : "BECOMEARTIST",
					"userEmail" : userEmail
				};

				$.ajax({
					url : "data/applicationLayer.php",
					type : "POST",
					data : jsonData,
					dataType : "json",
					contentType : "application/x-www-form-urlencoded",
					success: function(jsonResponse){
						getUserInfo();
						alert('You are now an artist!');
					},
					error : function(errorMessage){
						console.log(errorMessage.responseText);
					}
				});
			});

			// Logout
			$("#logout").click(function(){
				var jsonData = {
					"action" : "LOGOUT"
				};

				$.ajax({
					url : "data/applicationLayer.php",
					type : "POST",
					data : jsonData,
					dataType : "json",
					contentType : "application/x-www-form-urlencoded",
					success: function(jsonResponse){
						logged = false;
						window.location.replace("index.html");
					},
					error : function(errorMessage){
						console.log(errorMessage.responseText);
					}
				});
			});
		});
	</script>
	<!--Footer-->
	<?php include('footer.html'); ?>
</html>
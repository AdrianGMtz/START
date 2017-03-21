$(document).ready(function(){
	// Used to check the state of the user
	var logged = false;
	var userID = '';
	var userEmail = '';

	// Verify if any session exists
	checkUserStatus();
	// Verify if any cookie exists
	checkCookie();

	// Check Session
	function checkUserStatus() {
		var jsonData = {
			"action" : "CHECKSESSION"
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
				$("#userID").text(userID);
				$(".loggedIN").show();
				$(".loggedOUT").hide();
			},
			error : function(errorMessage){
				logged = false;
				$(".loggedIN").hide();
				$(".loggedOUT").show();
				$("#userID").text("");
			}
		});
	}

	// Check Cookie
	function checkCookie() {
		var jsonData2 = {
			"action" : "CHECKCOOKIE"
		};

		$.ajax({
			url : "data/applicationLayer.php",
			type : "POST",
			data : jsonData2,
			dataType : "json",
			contentType : "application/x-www-form-urlencoded",
			success: function(jsonResponse){
				$("#cookieCheckbox").attr('checked', true);
				$("#email").val(jsonResponse.cookie);
			},
			error : function(errorMessage){
				$("#cookieCheckbox").attr('checked', false);
			}
		});
	}

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

	// Login
	$("#login").click(function(){
		if ($('#email').val() != "" && $('#password').val() != ""){
			var jsonObject = {
				"action": "LOGIN",
				"email": $('#email').val(),
				"cookie" : $("#cookieCheckbox").is(":checked"),
				"password": $('#password').val()
			};
			
			$.ajax({
				type:'POST',
				url:'data/applicationLayer.php',
				data: jsonObject,
				dataType:'json',
				contentType : "application/x-www-form-urlencoded",
				success: function(jsonData){
					logged = true;
					//checkUserStatus();
					// Send the user to the profile page
					window.location.replace("profile.php");
					alert(jsonData.message);
				},
				error:function(errorMessage){
					alert("Error trying to login!");
				}
			});
		} else {
			alert("Complete all fields!");
		}
	});

	// Change Password
	$("#changePassword").click(function(){
		if ($('#oldPass').val() != "" && $('#newPass').val() != "" && $('#newPass2').val() != ""){
			var jsonObject = {
				"action": "CHANGEPSSWD",
				"email": $('#email').val(),
				"oldPass": $('#oldPass').val(),
				"newPass": $('#newPass').val(),
				"newPass2": $('#newPass2').val()
			};
			
			$.ajax({
				type:'POST',
				url:'data/applicationLayer.php',
				data: jsonObject,
				dataType:'json',
				contentType : "application/x-www-form-urlencoded",
				success: function(jsonData){
					logged = true;
					//checkUserStatus();
					// Send the user to the profile page
					window.location.replace("settings.php");
					alert(jsonData.message);
				},
				error:function(errorMessage){
					alert("Error trying to change password!");
				}
			});
		} else {
			alert("Complete all fields!");
		}
	});

	// Sign Up
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
					logged = true;
					//checkUserStatus();
					// Send the user to the profile page
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
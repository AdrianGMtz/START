$(document).ready(function(){

	$("#login").click(function(){
		if ($('#email').val() != "" && $('#password').val() != ""){
			var jsonObject = {
				"action": "LOGIN",
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

	// Login
	$("#loginButton").click(function(){
        var jsonData = {
            "email" : $("#emailLogin").val(),
            "password" : $("#passwordLogin").val(),
            "cookie" : $("#cookieCheckbox").is(":checked"),
            "action" : "LOGIN"
        };

        $.ajax({
			url : "data/applicationLayer.php",
			type: "POST",
			data: jsonData,
			dataType : "json",
			contentType : "application/x-www-form-urlencoded",
			success: function(jsonResponse){
				$("#userForm").hide(400);
				$("#infoMessage").html("<h2>" + jsonResponse.message + "</h2>");
                $("#dialogInfo").show(400);
				$(':input', '#userForm').not(':button').val('');
				logged = true;
				checkUserStatus();
			},
			error: function(errorMessage){
				$("#infoMessage").html("<h2>Could not login!</h2>");
                $("#dialogInfo").show(400);
			}
        });
    });
});
$(document).ready(function () {

	function scrollSmoothToBottom() {
		var div = $('.chat-history').get(0);
		$('.chat-history').animate({
		scrollTop: div.scrollHeight - div.clientHeight
		}, 250);
	}

	$('#talkSendMessage').submit(function(e) {
		e.preventDefault();

		var form = $(this)[0];
		
		var type = form.elements['type'].value;

		var data = {
			'message-data' : form.elements['message-data'].value,
			'_id' : form.elements['_id'].value,
			'type' : type
		};

		if ($('#message-data').val() != '') {
			$.ajax({
				url : "/message/send",
				type: "POST",
				data: data,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				dataType : "json",
				contentType : "application/x-www-form-urlencoded",
				success: function(jsonResponse){
					$('#talkMessages').append(jsonResponse.html);
					form.reset();
					$('#message-data').height('85');
					scrollSmoothToBottom();
				},
				error: function(errorMessage){
					console.log(errorMessage);
				}
			});
		}
	});

	$("#talkSendMessage button").click(function (e) {
		e.preventDefault() // cancel form submission

		// Check which button was pressed
		if ($(this).attr("value") == "text") {
			$('#type').val(1);
			$("#talkSendMessage").submit();
		}else if ($(this).attr("value") == "file") {
			$('#type').val(2);
			$("#talkSendMessage").submit();
		}else if ($(this).attr("value") == "payment") {
			$('#type').val(3);
			$("#talkSendMessage").submit();
		}
	});

	$('#message-data').keydown(function(event) {
		var tag = $(this);
		if (tag.scrollTop()) {
			tag.height(function(i,h){
				return h + 20;
			});
		}
		if (event.keyCode == 13 && !event.shiftKey) {
			$('#type').val(1);
			
			$('#talkSendMessage').submit();

			return false;
		}
	});

	scrollSmoothToBottom();
});

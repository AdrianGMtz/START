$(document).ready(function () {

	function scrollSmoothToBottom() {
		var div = $('.chat-history').get(0);
		$('.chat-history').animate({
		scrollTop: div.scrollHeight - div.clientHeight
		}, 250);
	}

	$('#talkSendMessage').submit(function(e) {
		e.preventDefault();

		var tag = $(this);
		var data = tag.serialize();

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
					tag[0].reset();
					$('#message-data').height('7rem');
					scrollSmoothToBottom();
				},
				error: function(errorMessage){
					console.log(errorMessage);
				}
			});
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
			$('#talkSendMessage').submit();

			return false;
		}
	});

	scrollSmoothToBottom();
});

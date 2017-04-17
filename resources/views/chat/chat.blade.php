@extends('layouts.app')

@section('content')
	<div class="row" style="margin-bottom: 0px;">
		<div class="chat-container clearfix">
			<div class="col s12 m3">
				@include('chat.peoplelist')
			</div>
			<div class="col s12 m9">
				<div class="chat">
					<div class="chat-header clearfix">
						@if($user->id == auth()->user()->id)
							<div class="chat-about">
								<div class="chat-with">No Thread Selected</div>
							</div>
						@else
							@if(isset($user))
								<img class="circle responsive-img" src="https://help.sketchbook.com/knowledgebase/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" alt="profile" style="width: 5%;"/>
							@endif
							<div class="chat-about">
								@if(isset($user))
									<div class="chat-with">{{@$user->name}}</div>
								@else
									<div class="chat-with">No Thread Selected</div>
								@endif
							</div>
						@endif
					</div> <!-- end chat-header -->

					@include('chat.conversations')
					
					{{-- Display Chat input when messaging another user --}}
					@if($user->id != auth()->user()->id)
						<div class="chat-message clearfix">
							<form action="" method="post" id="talkSendMessage" name="talkSendMessage">
								<div class="row">
									<div class="col s11" style="padding-right: 8px;">
										<textarea name="message-data" id="message-data" placeholder ="Type your message" rows="3" maxlength="500" autofocus></textarea>
										<input type="hidden" name="_id" value="{{@request()->route('id')}}">
										<input type="hidden" id="type" name="type" value="1">
									</div>
									<div class="col s1 center">
										<button class="waves-effect waves-light btn blue send" type="submit" value="text">Send</button>
										<button class="waves-effect waves-light btn-floating green" type="submit" value="payment"><i class="material-icons">attach_money</i></button>
										<button class="waves-effect waves-light btn-floating orange" type="submit" value="file"><i class="material-icons">attach_file</i></button>
									</div>
								</div>
							</form>
						</div> <!-- end chat-message -->
					@endif
				</div> <!-- end chat -->
			</div>
		</div>
		<script src="{{asset('/js/talk.js')}}"></script>
		<script type="text/javascript">
			function scrollSmoothToBottom() {
				var div = $('.chat-history').get(0);
				$('.chat-history').animate({
				scrollTop: div.scrollHeight - div.clientHeight
				}, 250);
			}

			function msgshow(data) {
				// Check Message Type
				if (data.type == 1) {
					// Text
					message = data.message;
				} else if (data.type == 2) {
					// File
					message = '<a class="white-text" href="' + data.message + '"><i class="material-icons">attach_file</i> File</a>';
				} else {
					// Payment
					message = '<b><u>Receipt:</u></b> <br> ' + data.message;
				}
				var html = '<li class="clearfix" id="message-' + data.id + '">' +
				'<div class="message-data">' +
				'<span class="message-data-name">' + data.sender.name + '</span>' + '&nbsp; &nbsp;' +
				'<span class="message-data-time">1 Second ago</span>' +
				'</div>' +
				'<div class="message other-message float-left">' +
				message +
				'</div>' +
				'</li>';

				$('#talkMessages').append(html);
				scrollSmoothToBottom();
			}
		</script>
		{!! talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]) !!}
	</div>
@endsection('content')

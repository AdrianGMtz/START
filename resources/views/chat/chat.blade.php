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
						@if($requested_user->id == auth()->user()->id)
							<div class="chat-about">
								<div class="chat-with">No Thread Selected</div>
							</div>
						@else
							@if(isset($requested_user))
								<img class="circle responsive-img" src="https://help.sketchbook.com/knowledgebase/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" alt="profile" style="width: 5%;"/>
								<div class="chat-about">
									<div class="chat-with">{{@$requested_user->name}}</div>
								</div>
							@endif
						@endif
					</div> <!-- end chat-header -->

					@include('chat.conversations')
					
					{{-- Display Chat input when messaging another user --}}
					@if($requested_user->id != auth()->user()->id)
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
										@if(auth()->user()->artist == 1)
											<button data-target="payment" class="waves-effect waves-light btn-floating green"><i class="material-icons">attach_money</i></button>
										@endif
										<button class="waves-effect waves-light btn-floating orange" type="submit" value="file"><i class="material-icons">attach_file</i></button>
									</div>
								</div>
							</form>
						</div> <!-- end chat-message -->
						{{-- Load Payment Modal with commissions if user is an artist --}}
						@if(auth()->user()->artist == 1)
							<!-- Payment Modal -->
							<div id="payment" class="modal">
								<div class="modal-content">
									<h4 class="center">Request Payment</h4>
									<hr>
									<br>
									<form action="" method="post" id="talkSendPayment" name="talkSendPayment">
										<div class="input-field">
											<select id="commissions" required>
												<option value="" disabled selected></option>
												@foreach($commissions as $commission)
													<option value="{{$commission->id}}" name="commission_id">{{$commission->type}}</option>
												@endforeach
											</select>
											<label for="commissions"><b>Choose a commission type:</b></label>
										</div>
										<div class="input-field">
											<input id="commission_description" type="text" name="commission_description" placeholder=" " disabled required>
											<label for="commission_description"><b>Commission Details:</b></label>
										</div>
										<div class="input-field">
											<textarea class="materialize-textarea" name="commission_comments" id="commission_comments" placeholder ="Type your message" rows="3" maxlength="300"></textarea>
											<label for="commission_comments"><b>Comments:</b></label>
										</div>
										<input type="hidden" name="_id" value="{{@request()->route('id')}}">
									</form>
								</div>
								<div class="modal-footer">
									<button type="submit" form="talkSendPayment" class="modal-action modal-close waves-effect waves-light btn green btn-medium" style="margin-left: 4px;">Charge</button>
									<button class="modal-action modal-close waves-effect waves-light btn red btn-medium" type="reset" style="margin-right: 4px;">Cancel</button>
								</div>
							</div>
						@endif
					@endif
				</div> <!-- end chat -->
			</div>
		</div>
		<script src="{{asset('/js/talk.js')}}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#payment').modal({
					dismissible: false, // Modal can't be dismissed by clicking outside of the modal
					opacity: .8, // Opacity of modal background
					inDuration: 300, // Transition in duration
					outDuration: 200 // Transition out duration
				});
				
				$('select').material_select();

				var commissions = <?php echo $commissions;?>;
				
				$('#commissions').change(function() {
					var id = $("#commissions option:selected").val();

					var description = commissions[id - 1].description + '  $' + commissions[id - 1].price;

					$('#commission_description').val(description);
				});
			});

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
					message = '<b><u>Order:</u></b> <br> ' + data.message + '<br> <a href="/orders/' + data.sender.id + '/latest"class="waves-effect waves-light btn green btn-medium">View</a>';
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

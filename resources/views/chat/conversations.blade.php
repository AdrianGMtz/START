<div class="chat-history">
	<ul id="talkMessages">
		@foreach($messages as $message)
			@if($message->sender->id == auth()->user()->id)
				<li class="clearfix" id="message-{{$message->id}}">
					<div class="message-data align-right">
						<span class="message-data-time" >{{$message->humans_time}} ago</span> &nbsp; &nbsp;
						<span class="message-data-name" >{{$message->sender->name}}</span>
					</div>
					<div class="message my-message float-right">
						{{$message->message}}
					</div>
				</li>
			@else
				<li class="clearfix" id="message-{{$message->id}}">
					<div class="message-data">
						<span class="message-data-name">{{$message->sender->name}}</span>  &nbsp; &nbsp;
						<span class="message-data-time">{{$message->humans_time}} ago</span>
					</div>
					<div class="message other-message float-left">
						{{$message->message}}
					</div>
				</li>
			@endif
		@endforeach
	</ul>
</div> <!-- end chat-history -->

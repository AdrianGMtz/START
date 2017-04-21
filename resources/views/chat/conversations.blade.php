<div class="chat-history">
	<ul id="talkMessages">
		@foreach($messages as $message)
			<li class="clearfix" id="message-{{$message->id}}">
				@if($message->sender->id == auth()->user()->id)
					<div class="message-data align-right">
						<span class="message-data-time" >{{$message->humans_time}} ago</span> &nbsp; &nbsp;
						<span class="message-data-name" >{{$message->sender->name}}</span>
					</div>
					{{-- Text --}}
					@if ($message->type == 1)
						<div class="message my-message float-right">
							{{$message->message}}
						</div>
					{{-- File --}}
					@elseif ($message->type == 2)
						<div class="message my-message float-right">
							<a class="white-text" href="{{$message->message}}"><i class="material-icons">attach_file</i> File</a>
						</div>
					{{-- Payment --}}
					@elseif ($message->type == 3)
						<div class="message my-message float-right">
							<b><u>Order:</u></b>
							<br>
							{{$message->message}}
							<br>
							<a href="/orders/{{$client_orders[$client_order_count]->id}}" class="waves-effect waves-light btn green btn-medium">View</a>
						</div>
						@php
							$client_order_count -= 1;
						@endphp
					@endif
				@else
					<div class="message-data">
						<span class="message-data-name">{{$message->sender->name}}</span>  &nbsp; &nbsp;
						<span class="message-data-time">{{$message->humans_time}} ago</span>
					</div>
					{{-- Text --}}
					@if ($message->type == 1)
						<div class="message other-message float-left">
							{{$message->message}}
						</div>
					{{-- File --}}
					@elseif ($message->type == 2)
						<div class="message other-message float-left">
							<a class="white-text" href="{{$message->message}}"><i class="material-icons">attach_file</i> File</a>
						</div>
					{{-- Payment --}}
					@elseif ($message->type == 3)
						<div class="message other-message float-left">
							<b><u>Order:</u></b>
							<br>
							{{$message->message}}
							<br>
							<a href="/orders/{{$user_orders[$user_order_count]->id}}" class="waves-effect waves-light btn green btn-medium">View</a>
							@php
								$user_order_count -= 1;
							@endphp
						</div>
					@endif
				@endif
			</li>
		@endforeach
	</ul>
</div> <!-- end chat-history -->

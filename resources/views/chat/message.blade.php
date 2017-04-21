<li class="clearfix" id="message-{{$message->id}}">
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
	@else
		<div class="message my-message float-right">
			<b><u>Order:</u></b>
			<br>
			{{$message->message}}
			<br>
			<a href="/orders/{{$order_id}}" class="waves-effect waves-light btn green btn-medium">View Order</a>
		</div>
	@endif
</li>

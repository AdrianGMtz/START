@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col m10 offset-m1">
				<div class="card">
					<div class="card-content">
						@if (Session::get('success'))
							<div class="card-panel green lighten-1 card-content valign">
								<ul class="white-text">
									<li>Payment posted successfully</li>
								</ul>
							</div>
							<?php Session::forget('success');?>
						@elseif ($message = Session::get('error'))
							<div class="card-panel red lighten-1 card-content valign">
								<ul class="white-text">
									<li>{!! $message !!}</li>
								</ul>
							</div>
							<?php Session::forget('error');?>
						@endif
						
						<h2 class="center">Order #{{$order->id}}</h2>
						<hr>
						<form method="POST" id="payment-form" class="center" action="/pay/{{$order->id}}" >
							{{ csrf_field() }}

							<h5><b>Description:</b></h5>
							<p class="center">{{ $commission->description }}</p>

							<h5><b>Commission Type:</b></h5>
							<p class="center">{{ $commission->type }}</p>

							<h5><b>Artist:</b></h5>
							<p class="center">{{ $artist->name }}</p>

							<h5><b>Price:</b></h5>
							<p class="center">${{ $commission->price }}</p>

							@if($order->order_comments != '')
								<h5><b>Comments:</b></h5>
								<p class="center">{{ $order->order_comments }}</p>
							@endif

							<input id="commission_description" type="text" class="validate" name="commission_description" value="{{ $commission->description }}" hidden>
							<input id="commission_type" type="text" class="validate" name="commission_type" value="{{ $commission->type }}" hidden>
							<input id="commission_price" type="text" class="validate" name="commission_price" value="{{ $commission->price }}" hidden>
							<input id="artist_id" type="text" class="validate" name="artist_id" value="{{ $artist->id }}" hidden>
							<input id="order_id" type="text" class="validate" name="order_id" value="{{ $order->id }}" hidden>

							@include ('layouts.errors')
						</form>
						<div class="center">
							<hr>

							<a class="waves-effect waves-light btn blue" href="{{ URL::previous() }}">Back</a>

							@if((auth()->user()->id != $artist->id) && ($order->paid == 0))
								<button type="submit" form="payment-form" class="waves-effect waves-light btn green" style="margin-left: 5%;">Pay</button>
							@endif

							@if($order->paid == 1)
								{{-- show files --}}
							@else
								<br>
								<br>
								<p class="center">*Files will become available after payment is processed.</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

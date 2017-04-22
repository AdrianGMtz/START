@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col m12">
				<h2 class="center">Orders</h2>
			</div>
			@if(auth()->user()->artist == 1)
				<div class="col m12">
					<div class="card">
						<div class="card-content">
							<h3 class="card-title center"><b>User Orders</b></h3>
						@if(count($client_orders))
							<table class="responsive-table striped bordered centered">
								<thead>
									<tr>
										<th>Order #</th>
										<th>Date</th>
										<th>Client</th>
										<th>Commission Type</th>
										<th>Commission Description</th>
										<th>Price</th>
										<th>Paid</th>
										<th>Details</th>
									</tr>
								</thead>
								<tbody>
									@foreach($client_orders as $order)
										<tr>
											<td>{{ $order->id }}</td>
											<td>{{ $order->created_at->toFormattedDateString() }}</td>
											<td>{{ App\User::find($order->client_id)->name }}</td>
											<td>{{ App\Commission::find($order->commission_id)->type }}</td>
											<td>{{ App\Commission::find($order->commission_id)->description }}</td>
											<td>${{ App\Commission::find($order->commission_id)->price }}</td>
											<td>
												@if($order->paid == 0)
													No
												@else
													Yes
												@endif
											</td>
											<td><a href="/orders/{{ $order->id }}" class="waves-effect waves-light btn green btn-medium">View</a></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<p>No orders to display.</p>
						@endif
						</div>
					</div>
				</div>
				<div class="col m12">
					<div class="card">
						<div class="card-content">
							<h3 class="card-title center"><b>My Orders</b></h3>
							@if(count($user_orders))
								<table class="responsive-table striped bordered centered">
									<thead>
										<tr>
											<th>Order #</th>
											<th>Date</th>
											<th>Artist</th>
											<th>Commission Type</th>
											<th>Commission Description</th>
											<th>Price</th>
											<th>Paid</th>
											<th>Details</th>
										</tr>
									</thead>
									<tbody>
										@foreach($user_orders as $order)
											<tr>
												<td>{{ $order->id }}</td>
												<td>{{ $order->created_at->toFormattedDateString() }}</td>
												<td>{{ App\User::find($order->user_id)->name }}</td>
												<td>{{ App\Commission::find($order->commission_id)->type }}</td>
												<td>{{ App\Commission::find($order->commission_id)->description }}</td>
												<td>${{ App\Commission::find($order->commission_id)->price }}</td>
												<td>
													@if($order->paid == 0)
														No
													@else
														Yes
													@endif
												</td>
												<td><a href="/orders/{{ $order->id }}" class="waves-effect waves-light btn green btn-medium">View</a></td>
											</tr>
										@endforeach
									</tbody>
								</table>
							@else
								<p>No orders to display.</p>
							@endif
						</div>
					</div>
				</div>
			@else
				<div class="col m12">
					<div class="card">
						<div class="card-content">
							<h3 class="card-title center"><b>My Orders</b></h3>
							@if(count($user_orders))
								<table class="responsive-table striped bordered centered">
									<thead>
										<tr>
											<th>Order #</th>
											<th>Date</th>
											<th>Artist</th>
											<th>Commission Type</th>
											<th>Commission Description</th>
											<th>Price</th>
											<th>Paid</th>
											<th>Details</th>
										</tr>
									</thead>
									<tbody>
										@foreach($user_orders as $order)
											<tr>
												<td>{{ $order->id }}</td>
												<td>{{ $order->created_at->toFormattedDateString() }}</td>
												<td>{{ App\User::find($order->user_id)->name }}</td>
												<td>{{ App\Commission::find($order->commission_id)->type }}</td>
												<td>{{ App\Commission::find($order->commission_id)->description }}</td>
												<td>${{ App\Commission::find($order->commission_id)->price }}</td>
												<td>
													@if($order->paid == 0)
														No
													@else
														Yes
													@endif
												</td>
												<td><a href="/orders/{{ $order->id }}" class="waves-effect waves-light btn green btn-medium">View</a></td>
											</tr>
										@endforeach
									</tbody>
								</table>
							@else
								<p>No orders to display.</p>
							@endif
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection

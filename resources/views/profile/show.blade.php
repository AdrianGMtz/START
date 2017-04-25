@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<!-- User info bar -->
			@include ('profile.info')

			<!-- Commission Details -->
			{{-- <div class="col s12 m8 l9">
				<h5 class="center">Commissions</h5>
				@if ($user->id == auth()->user()->id)
					@if($user->artist)
						<a class="waves-effect waves-light btn blue" href="/profile/create"><i class="material-icons">note_add</i></a>

						@if (count($commissions))
							<!-- Commissions -->
							<div class="row">
				                @foreach ($commissions as $commission)
				                    @include ('commissions.commission')
				                @endforeach
				            </div>
				        @else
				        	<!-- Message for artist -->
							<div class="card-panel blue lighten-5 card-content valign center">
								<h5 class="blue-text text-lighten-2">You're not offering any commissions.</h5>
							</div>
						@endif
					@else
						Message for non artists
						<div class="card-panel blue lighten-5 card-content valign center">
							<h5 class="blue-text text-lighten-2">You must be an artist to offer commissions.</h5>
							<br>
							<a class="waves-effect waves-light btn blue" href="/profile/becomeArtist">Become an artist</a>
						</div>
					@endif
				@else
					@if (count($commissions))
						<!-- Commissions -->
						<div class="row">
							@foreach ($commissions as $commission)
								@include ('commissions.commission')
							@endforeach
						</div>
					@else
						<!-- Message for artist -->
						<div class="card-panel blue lighten-5 card-content valign center">
							<h5 class="blue-text text-lighten-2">This artist isn't offering any commissions at this time.</h5>
						</div>
					@endif
				@endif
			</div> --}}

			<!-- Commission Details -->
			@include ('commissions.details')
		</div>
	</div>
@endsection('content')
@extends('layouts.app')

@section('content')
	<div class="row">
		<!-- User info bar -->
		<div class="card-panel col s12 m4 l3 grey lighten-4">
			<!-- User Image -->
			<img class="responsive-img " src="https://help.sketchbook.com/knowledgebase/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png">
			
			<!-- User Name -->
			<h5 id="username" class="center">{{ $user->name }}</h5>

			<!-- User Description -->
			<p id="description">{{ $user->description }}</p>
			
			<!-- Profile Edit / Message Artist -->
			<div class="center">
				<a class="waves-effect waves-light btn blue" href="/profile/edit">Edit</a>
				<a class="waves-effect waves-light btn blue artist">Message</a>
			</div>
			<br>
		</div>

		<!-- Commissions area -->
		<div class="col s12 m8 l9">
			<h5 class="center">Commissions</h5>
			@if($user->artist)
				<!-- Message for artist -->
				<a class="waves-effect waves-light btn blue" href="/profile/create"><i class="material-icons">note_add</i></a>
				<div class="card-panel blue lighten-5 card-content valign center">
					<h5 class="blue-text text-lighten-2">You're not offering any commissions.</h5>
				</div>
			@else
				<!-- Message for non artists -->
				<div class="card-panel blue lighten-5 card-content valign center">
					<h5 class="blue-text text-lighten-2">You must be an artist to offer commissions.</h5>
					<br>
					<button class="waves-effect waves-light btn blue" id="becomeArtistBtn">Become an artist</button>
				</div>
			@endif

			<!-- Commission -->
			<div class="row artist" id="commissions">
			</div>
		</div>
	</div>
@endsection('content')
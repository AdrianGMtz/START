<div class="card-panel col s12 m3 grey lighten-4">
	<!-- User Image -->
	<img class="responsive-img" src="https://drive.google.com/uc?id={{ $user->image }}">
	
	<!-- User Name -->
	<h5 id="username" class="center">{{ $user->name }}</h5>

	<!-- User Description -->
	<p id="description">{{ $user->description }}</p>
	
	<!-- Profile Edit / Message Artist -->
	<div class="center">
		@if ($user->id == auth()->user()->id)
			<a class="waves-effect waves-light btn blue" href="/profile/edit">Edit</a>
		@else
			<a class="waves-effect waves-light btn blue" href="/message/{{ $user->id }}">Message</a>
		@endif
	</div>
	<br>
</div>
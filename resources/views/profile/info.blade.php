<div class="card-panel col s12 m4 l3 grey lighten-4">
	<!-- User Image -->
	<img class="responsive-img " src="https://help.sketchbook.com/knowledgebase/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png">
	
	<!-- User Name -->
	<h5 id="username" class="center">{{ $user->name }}</h5>

	<!-- User Description -->
	<p id="description">{{ $user->description }}</p>
	
	<!-- Profile Edit / Message Artist -->
	<div class="center">
		@if ($user->id == auth()->user()->id)
			<a class="waves-effect waves-light btn blue" href="/profile/edit">Edit</a>
		@else
			<a class="waves-effect waves-light btn blue artist">Message</a>
		@endif
	</div>
	<br>
</div>
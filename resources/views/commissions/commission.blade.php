<div class="col s6">
	<div class="card">
		<div class="card-image">
			<img class="commission-image" src="https://drive.google.com/uc?id={{ $commission->images()->first()->image }}">
			@if (auth()->check() && $user->id == auth()->user()->id)
				<a class="btn-floating halfway-fab waves-effect waves-light blue" href="/commissions/{{ $commission->id }}/edit"><i class="material-icons">mode_edit</i></a>
			@endif
		</div>
		<div class="card-content center">
			<p><b>{{ $commission->description }}</b></p>
			<p>${{ $commission->price }}</p>
		</div>
		<div class="card-action center">
			<a href="/commissions/{{ $commission->id }}">More Info</a>
		</div>
	</div>
</div>


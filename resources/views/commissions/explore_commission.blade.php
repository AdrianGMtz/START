<div class="col s3">
	<div class="card small">
		<div class="card-image">
			<img src="https://drive.google.com/uc?id={{ $commission->images()->first()->image }}" height="150px">
			{{-- <span class="card-title black-text">{{ $commission->user->name }}</span> --}}
		</div>
		<div class="card-content center">
			<p><b>{{ $commission->user->name }}</b></p>
			{{-- <p>{{ $commission->type }}</p> --}}
			<p>${{ $commission->price }}</p>
		</div>
		<div class="card-action center">
			<a href="commissions/{{ $commission->id }}">More Info</a>
		</div>
	</div>
</div>
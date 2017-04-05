<div class="col s3">
	<div class="card">
		<div class="card-image">
			<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
			{{-- <span class="card-title black-text">{{ $commission->user->name }}</span> --}}
			@if ($user->id == auth()->user()->id)
				<a class="btn-floating halfway-fab waves-effect waves-light blue" href="/commissions/{{ $commission->id }}/edit"><i class="material-icons">mode_edit</i></a>
			@endif
		</div>
		<div class="card-content center">
			{{-- <p>{{ $commission->user->name }}</p> --}}
			<p><b>{{ $commission->type }}</b></p><p>${{ $commission->price }}</p>
		</div>
		<div class="card-action">
			<a href="commissions/{{ $commission->id }}">More Info</a>
		</div>
	</div>

</div>


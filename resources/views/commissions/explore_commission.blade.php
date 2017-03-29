<div class="col s3">
	<div class="card small">
		<div class="card-image">
			<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
			{{-- <span class="card-title black-text">{{ $commission->user->name }}</span> --}}
		</div>
		<div class="card-content">
			<p><b>{{ $commission->user->name }}</b></p>
			<p>{{ $commission->type }} - ${{ $commission->price }}</p>
		</div>
		<div class="card-action">
			<a href="commissions/{{ $commission->id }}">More Info</a>
		</div>
	</div>
</div>
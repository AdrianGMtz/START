@if (count($errors))
	<div class="card-panel red lighten-1 card-content valign">
		<ul class="white-text">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
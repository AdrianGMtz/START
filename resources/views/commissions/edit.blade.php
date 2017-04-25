@extends ('layouts.app')

@section ('content')
	<div class="row">
		<form class="col s12" method="POST" action="/commissions/{{ $commission->id }}/edit">

			{{ csrf_field() }}

			<h5>Edit Commission</h5>
			<div class="row">
				<div class="input-field col s12">
					<input id="description" type="text" class="validate" name="description" value="{{ $commission->description }}" required>
					<label for="description">Description</label>
				</div>
				<div class="input-field col s12">
					<input id="type" type="text" class="validate" name="type" value="{{ $commission->type }}" required>
					<label for="type">Type</label>
				</div>
				<div class="input-field col s12">
					<input id="price" type="number" class="validate" name="price" min="1" step="any" placeholder="0.00" value="{{ $commission->price }}" required>
					<label for="price">Price</label>
				</div>
			</div>
			<a class="waves-effect waves-light btn red" href="/commissions/{{ $commission->id }}/delete">Delete</a>
			<button type="submit" class="waves-effect waves-light btn blue" style="margin-left: 10px; margin-right: 10px;">Save</button>
			<button type="button" class="waves-effect waves-light btn red" onclick="window.location='/profile'">Cancel</button>

			@include ('layouts.errors')
		</form>
	</div>
@endsection
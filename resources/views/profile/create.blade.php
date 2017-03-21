@extends ('layouts.app')

@section ('content')
	<div class="row">
		<form class="col s12" method="POST" action="/commissions">

			{{ csrf_field() }}

			<h5>Add Commission</h5>
			<div class="row">
				<div class="input-field col s12">
					<input id="description" type="text" class="validate" name="description" required>
					<label for="description">Description</label>
				</div>
				<div class="input-field col s12">
					<input id="type" type="text" class="validate" name="type" required>
					<label for="type">Type</label>
				</div>
				<div class="input-field col s12">
					<input id="price" type="number" class="validate" name="price" min="1" step="any" placeholder="0.00"  required>
					<label for="price">Price</label>
				</div>
			</div>
			<button type="submit" class="waves-effect waves-light btn blue">Save</button>
			<button type="button" class="waves-effect waves-light btn red" onclick="window.location='{{ URL::previous() }}'">Cancel</button>

			@include ('layouts.errors')
		</form>
	</div>
@endsection
@extends('layouts.app')

@section('content')
	<div class="row">
		<!-- Edit Description -->
		<form class="col s12" method="POST" action="/profile/edit">
			{{ csrf_field() }}

			<h4>Edit Description</h4>
			<div class="row">
				<div class="input-field col s12">
					<input id="description" type="text" class="validate" name="description" required>
					<label for="description">User Description</label>
				</div>
			</div>
			<button type="submit" class="waves-effect waves-light btn blue">Save</button>
			<button type="button" class="waves-effect waves-light btn red" onclick="window.location='{{ URL::previous() }}'">Cancel</button>

			@include ('layouts.errors')
		</form>
	</div>
@endsection('content')
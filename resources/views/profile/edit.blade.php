@extends('layouts.app')

@section('content')
	<div class="row">
		<!-- Edit Description -->
		<form class="col s12" method="POST" action="/profile/edit" enctype="multipart/form-data">
			{{ csrf_field() }}

			<h4>Edit Description</h4>
			<div class="row">
				<div class="input-field col s12">
					<input id="description" type="text" class="validate" name="description" value="{{ $user->description }}" required>
					<label for="description">User Description</label>
				</div>
				<div class="input-field col s12">
					<input type="file" name="avatar"></input>
				</div>
			</div>
			<button type="submit" class="waves-effect waves-light btn blue">Save</button>
			<button type="button" class="waves-effect waves-light btn red" onclick="window.location='/profile'">Cancel</button>

			@include ('layouts.errors')
		</form>
	</div>
@endsection('content')
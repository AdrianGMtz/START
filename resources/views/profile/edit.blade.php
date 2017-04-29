@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="card-panel grey lighten-4 col s12 m8 offset-m2">
				<!-- Edit Description -->
				<form method="POST" action="/profile/edit">
					{{ csrf_field() }}

					<h4 class="center">Edit Description</h4>

					<div class="row">
						<div class="input-field col s12">
							<input id="description" type="text" class="validate" name="description" value="{{ $user->description }}" required>
							<label for="description">User Description</label>
						</div>
					</div>

					@include ('layouts.errors')

					<div class="center">
						<button type="submit" class="waves-effect waves-light btn blue">Save</button>
						<button type="button" class="waves-effect waves-light btn red" onclick="window.location='/profile'">Cancel</button>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
@endsection('content')
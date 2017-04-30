@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="card-panel grey lighten-4 col s12 m8 offset-m2">
				<!-- Edit Description -->
				<form method="POST" action="/profile/edit" enctype="multipart/form-data">
					{{ csrf_field() }}

					<h4 class="center">Edit Profile</h4>

					<div class="row">
						<div class="input-field col s10 offset-s1">
							<input id="description" type="text" class="validate" name="description" value="{{ $user->description }}" required>
							<label for="description">Description</label>
						</div>
					</div>
					
					<label class="col s10 offset-s1" for="avatar">Profile Image</label>
					<div class="row">
						<div class="file-field input-field col s10 offset-s1">
							<div class="waves-effect waves-light btn blue">
								<span>Choose File</span>
								<input id="avatar" name="avatar" type="file">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path" type="text" disabled>
							</div>
						</div>
					</div>

					@include ('layouts.errors')

					<div class="center">
						<button type="submit" class="waves-effect waves-light btn blue" style="margin-right: 10px;">Save</button>
						<button type="button" class="waves-effect waves-light btn red" onclick="window.location='/profile'">Cancel</button>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
@endsection('content')
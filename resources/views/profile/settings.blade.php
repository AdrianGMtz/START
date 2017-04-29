@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="card-panel grey lighten-4 col s12 m6 offset-m3">
			<!-- Change Password -->	
			<form method="POST" action="/settings">

				{{ csrf_field() }}
				<h4 class="center">Settings</h4>

				<h5 class="center">Change Password</h5>

				<!-- Old Password -->			
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">vpn_key</i>
						<input id="oldPassword" type="password" class="validate" name="oldPassword" required>
						<label for="oldPassword">Old Password </label>
					</div>
				</div>

				<!-- New Password -->
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">vpn_key</i>
						<input id="password" type="password" class="validate" name="password" required>
						<label for="password">New Password</label>
					</div>
				</div>

				<!-- Confirm New Password -->
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">vpn_key</i>
						<input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
						<label for="password-confirm">Confirm New Password</label>
					</div>
				</div>

				@include ('layouts.errors')
				
				<div class="center">
					<!-- Save button -->
					<button type="submit" class="waves-effect waves-light btn blue">Save</button>

					<!-- Cancel button -->
					<button type="button" class="waves-effect waves-light btn red" onclick="window.location='/profile'">Cancel</button>
				</div>
				<br>
			</form>
		</div>
	</div>
@endsection('content')
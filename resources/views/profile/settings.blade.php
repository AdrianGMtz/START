@extends('layouts.app')

@section('content')
	<div class="row">

		<!-- Change Password -->	
		<form class="col s12 m6 offset-m3" method="POST" action="/settings">

			{{ csrf_field() }}
			<h4>Settings</h4>

			<h5>Change Password</h5>

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

			<!-- Save button -->
			<button type="submit" class="waves-effect waves-light btn blue">Save</button>

			<!-- Cancel button -->
			<button type="button" class="waves-effect waves-light btn red" onclick="window.location='/profile'">Cancel</button>

			@include ('layouts.errors')
		</form>
	</div>
@endsection('content')
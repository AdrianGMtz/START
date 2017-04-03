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
					<input id="oldPass" type="password" class="validate" name="oldPass" required>
					<label for="oldPass"> Old Password  </label>
				</div>
			</div>

			<!-- New Password -->
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">vpn_key</i>
						<input id="newPass" type="password" class="validate" name="newPass" required>
						<label for="newPass"> New Password </label>

						@if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
					</div>
				</div>
			</div>

			<!-- Confirm New Password -->
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">vpn_key</i>
						<input id="newPass2" type="password" class="validate" name="newPass2" required>
						<label for="newPass2"> Repeat New Password </label>

						@if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
					</div>
				</div>
			</div>

			<!-- Save button -->
			<button type="submit" class="waves-effect waves-light btn blue">Save</button>

		</form>

		@include ('layouts.errors')
		
	</div>
@endsection('content')
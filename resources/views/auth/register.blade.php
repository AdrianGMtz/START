@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="card-panel grey lighten-4 col s12 m8 offset-m2">
				<h3 class="center">Register</h3>

				<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}

					<div class="row">
						<div class="input-field col s8 offset-s2">
							<input id="name" type="text" class="validate{{ $errors->has('name') ? ' invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

							<label for="name">Name</label>

							@if ($errors->has('name'))
								<div class="card-panel red lighten-1 card-content valign">
									<ul class="white-text">
										<li>{{ $errors->first('name') }}</li>
									</ul>
								</div>
							@endif
						</div>
					</div>

					<div class="row">
						<div class="input-field col s8 offset-s2">
							<input id="email" type="email" class="validate{{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{ old('email') }}" required>

							<label for="email">E-Mail</label>

							@if ($errors->has('email'))
								<div class="card-panel red lighten-1 card-content valign">
									<ul class="white-text">
										<li>{{ $errors->first('email') }}</li>
									</ul>
								</div>
							@endif
						</div>
					</div>

					<div class="row">
						<div class="input-field col s8 offset-s2">
							<input id="username" type="text" class="validate{{ $errors->has('username') ? ' invalid' : '' }}" name="username" value="{{ old('username') }}" required>

							<label for="username">Username</label>

							@if ($errors->has('username'))
								<div class="card-panel red lighten-1 card-content valign">
									<ul class="white-text">
										<li>{{ $errors->first('username') }}</li>
									</ul>
								</div>
							@endif
						</div>
					</div>

					<div class="row">
						<div class="input-field col s8 offset-s2">
							<input id="password" type="password" class="validate{{ $errors->has('password') ? ' invalid' : '' }}" name="password" required>

							<label for="password">Password</label>

							@if ($errors->has('password'))
								<div class="card-panel red lighten-1 card-content valign">
									<ul class="white-text">
										<li>{{ $errors->first('password') }}</li>
									</ul>
								</div>
							@endif
						</div>
					</div>

					<div class="row">
						<div class="input-field col s8 offset-s2">
							<input id="password-confirm" type="password" class="validate{{ $errors->has('password') ? ' invalid' : '' }}" name="password_confirmation" required>

							<label for="password-confirm">Confirm Password</label>
						</div>
					</div>

					<div class="center">
						<button type="submit" class="waves-effect waves-light btn blue">Register</button>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
@endsection

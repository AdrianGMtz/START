@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="card-panel grey lighten-4 col s12 m8 offset-m2">
				<h3 class="center">Login</h3>

				<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}

					<div class="row">
						<div class="input-field col s8 offset-s2">
							<input id="email" type="email" class="validate{{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
						<div class="col s6 offset-s4">
							<input type="checkbox" class="filled-in" name="remember" id="remember" checked="{{ old('remember') ? 'checked' : '' }}">

							<label for="remember">Remember Me</label>
						</div>
					</div>

					<div class="center">
						<button type="submit" class="waves-effect waves-light btn blue" style="margin-right: 10px;">Login</button>

						<a class="waves-effect waves-light btn blue" href="{{ route('password.request') }}">Forgot Your Password?</a>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
@endsection

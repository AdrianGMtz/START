@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="card-panel grey lighten-4 col s12 m8 offset-m2">
				<h3 class="center">Reset Password</h3>
				@if (session('status'))
					<div class="card-panel green lighten-1 card-content valign">
						<ul class="white-text">
							<li>{{ session('status') }}</li>
						</ul>
					</div>
				@endif

				<form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
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

					<div class="center">
						<button type="submit" class="waves-effect waves-light btn blue">Send</button>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
@endsection

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

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col m4 control-label">E-Mail Address</label>

					<div class="col m6">
						<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col m6 offset-m4">
						<button type="submit" class="btn btn-primary">
							Send Password Reset Link
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

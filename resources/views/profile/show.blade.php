@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<!-- User info bar -->
			@include ('profile.info')

			<!-- Commission Details -->
			@include ('commissions.details')
		</div>
	</div>
@endsection('content')
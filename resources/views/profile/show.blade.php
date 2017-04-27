@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<!-- User info bar -->
			@include('profile.info')

			<!-- Commissions -->
			@include('commissions.commissions')
		</div>
	</div>
@endsection('content')
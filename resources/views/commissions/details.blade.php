@extends('layouts.app')

@section('content')
	<div class="col 8">
		<div class="card large">
			<div class="card-image">
				<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
			</div>
			<div class="card-content">
				<p>{{ $commission->user->name }}</p>
				<p>{{ $commission->description }}</p>
			</div>
			<div class="card-action">
				<a href="/message/{{ $commission->user->id }}">Message</a>
			</div>
		</div>
	</div>
@endsection
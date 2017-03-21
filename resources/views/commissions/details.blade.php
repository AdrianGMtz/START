@extends('layouts.app')

@section('content')
	<div class="col s3">
		<div class="card small">
			<div class="card-image">
				<img src="https://help.sketchbook.com/knowledgebase/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png">
				<span class="card-title black-text">{{ $commission->title }}</span>
			</div>
			<div class="card-content">
				<p>{{ $commission->user->name }}<br>{{ $commission->body }}</p>
			</div>
			<div class="card-action">
				<a href="commissions/{{ $commission->id }}">More Info</a>
			</div>
		</div>
	</div>
@endsection
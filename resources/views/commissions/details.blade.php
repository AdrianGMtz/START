@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<!-- User info bar -->
			@include('profile.info')

			<!-- Commission Details -->
			<div class="col s12 m9">
				<div id="commission_details" class="row">
					<div class="col s5">
						<a class="waves-effect waves-light btn blue" href="/profile/{{ $user->id }}" style="margin: .82rem 0 .656rem 0;">View all commissions</a>
					</div>
					<div class="col s5">
						<h5 style="display: inline-block;">Commission</h5>
					</div>
				</div>
				<div class="card grey darken-4 center">
					@if (auth()->check() && $user->id == auth()->user()->id)
						<a id="edit_btn" class="btn-floating halfway-fab waves-effect waves-light btn-large blue" href="/commissions/{{ $commission->id }}/edit"><i class="material-icons">mode_edit</i></a>
					@endif
					<div class="card-content white-text">
						<div class="slider">
							<ul class="slides">
								{{-- Create <li> per image in commission --}}
								@foreach($commission->images as $image)
									<li>
										<a href="#img{{ $image->id }}">
											<img src="https://drive.google.com/uc?id={{ $image->image }}">
										</a>
									</li>
								@endforeach
							</ul>
						</div>
						<p class="white-text left">{{ $commission->description }}</p>
					</div>
					<div class="card-action">
						<h5 class="white-text">Price: ${{ $commission->price }}</h5>
						@if(!auth()->check() || (auth()->check() && $user->id != auth()->user()->id))
							<a class="waves-effect waves-light btn orange btn-large" href="/message/{{ $user->id }}">Hire</a>
						@endif
					</div>
				</div>
				<!-- Gallery Modals -->
				<div id="zoom_images">
					{{-- Add img tag per image in commission --}}
					@foreach($commission->images as $image)
						<img class="modal lightbox" id="img{{ $image->id }}" src="https://drive.google.com/uc?id={{ $image->image }}">
					@endforeach
				</div>
				<!-- Policies Modal -->
				{{-- <div id="{{ $id }}_policies" class="modal">
					<div class="modal-content">
						<h4 class="center">Client Agreement</h4>
						<hr>
						<p><b> You agree to follow this artist's commission policies: </b></p>
						<ul>
							<li> No deadline </li>
							<li> At most 2 changes </li>
							<li> No refunds </li>
						</ul>
					</div>
					<div class="modal-footer">
						<hr>
						<a class="modal-action modal-close waves-effect waves-light btn red btn-medium" style="margin-left: 4px;" href="/message/{{ $commission->user_id }}">I Agree</a>
						<button class="modal-action modal-close waves-effect waves-light btn blue btn-medium" style="margin-right: 4px;">Cancel</button>
					</div>
				</div>--}}
			</div>
		</div>
	</div>
	{{-- <script type="text/javascript">
		$(document).ready(function(){
			$('#{{ $id }}_policies').modal({
				dismissible: false, // Modal can't be dismissed by clicking outside of the modal
				opacity: .8, // Opacity of modal background
				inDuration: 300, // Transition in duration
				outDuration: 200 // Transition out duration
			});
		});
	</script> --}}
	<script type="text/javascript">
		$(document).ready(function(){
			$('.slider').slider({
				height: 300,
				interval: 3300
			});
			$('.modal.lightbox').modal({
				opacity: 0.9
			});
		});
	</script>
@endsection('content')

@extends('layouts.app')

@section('content')
	<div class="row">
		<!-- User info bar -->
		@include ('profile.info')

		<!-- Commission Details -->
		<div class="col s12 m9">
			<ul id="tabs-swipe" class="tabs tabs-fixed-width" style="margin-top: 10px;">
				<li class="tab col s3"><a class="active red white-text" href="#photography">Photography</a></li>
				<li class="tab col s3"><a class="blue white-text" href="#digital-art">Digital Art</a></li>
				<li class="tab col s3"><a class="green white-text" href="#sketch">Sketches</a></li>
			</ul>

			<div id="photography" class="col s12 white details" style="border-color:red;">
				<div class="card grey darken-4 center">
					<div class="card-content white-text">
						<div class="slider">
							<ul class="slides">
								<li>
									<a href="#img1">
										<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
									</a>
								</li>

								<li>
									<a href="#img2">
										<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
									</a>
								</li>
							</ul>
						</div>
						<p class="white-text left">A short description about the specific commission type will be placed here.</p>
					</div>
					<div class="card-action">
						<h5 class="white-text">Price: $20</h5>
						<a class="waves-effect waves-light btn orange btn-large" href="#policies">Hire</a>
					</div>
				</div>
				<!-- Gallery Modals -->
				<div id="zoom images">
					<img class="modal lightbox" id="img1" src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
					<img class="modal lightbox" id="img2" src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
				</div>
				<!-- Policies Modal -->
				<div id="policies" class="modal">
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
						<a href="#!" class="modal-action modal-close waves-effect waves-light btn red btn-medium" style="margin-left: 4px;">I Agree</a>
						<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue btn-medium" style="margin-right: 4px;">Cancel</a>
					</div>
				</div>
			</div>

			<div id="digital-art" class="col s12 white details" style="border-color:blue;">
				Digi
			</div>

			<div id="sketch" class="col s12 white details" style="border-color:green;">
				Ske
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.slider').slider({
					height: 288,
					interval: 3300
				});
				$('.modal').modal({
					dismissible: false, // Modal can't be dismissed by clicking outside of the modal
					opacity: .7, // Opacity of modal background
					inDuration: 300, // Transition in duration
					outDuration: 200 // Transition out duration
				});
			});
		</script>
	</div>
@endsection('content')
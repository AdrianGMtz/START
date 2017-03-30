@extends('layouts.app')

@section('content')
	<div class="row">
		<!-- User info bar -->
		@include ('profile.info')

		<!-- Commission Details -->
		<div class="col s12 m9">
			<div class="card-panel blue-grey darken-4 card-content valign center">
				<h4 class="white-text">Sketch</h4>
				<div class="slider">
					<ul class="slides">
						<li>
							<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg" class="materialboxed">
						</li>

						<li>
							<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg" class="materialboxed">
						</li>

						<li>
							<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg" class="materialboxed">
						</li>
					</ul>

					<h5 class="right-align white-text">Price: $20</h5>
				</div>
				<br>
				<p class="white-text left">A short description about the specific commission type will be placed here.</p>

				<br><br><br>

				<a class="waves-effect waves-light btn orange btn-large " href="#policies">Hire</a>
			</div> 
		</div>
		<!-- Modal Structure -->
		<div id="policies" class="modal">
			<div class="modal-content">
				<h4 class="center">Client Agreement</h4>
				<p><b> You agree to follow this artist's commission policies: </b></p>

				<ul>
					<li> No deadline </li>
					<li> At most 2 changes </li>
					<li> No refunds </li>
				</ul>

			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-orange btn-flat">I Agree</a>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.slider').slider({
					interval: 3300
				});
				$('.modal').modal();
				$('.materialboxed').materialbox();
			});
		</script>
	</div>
@endsection('content')
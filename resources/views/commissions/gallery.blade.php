 <div class="card grey darken-4 center">
	 @if ($user->id == auth()->user()->id)
		<a id="edit_btn" class="btn-floating halfway-fab waves-effect waves-light btn-large blue" href="/commissions/{{ $commission->id }}/edit"><i class="material-icons">mode_edit</i></a>
	@endif
	<div class="card-content white-text">
		<div class="slider">
			<ul class="slides">
				{{-- Create <li> per image in commission --}}
				<li>
					{{-- href is #img + commission id + commission image id --}}
					<a href="#img{{ $commission->id }}1">
						<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
					</a>
				</li>

				<li>
					<a href="#img{{ $commission->id }}2">
						<img src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
					</a>
				</li>
			</ul>
		</div>
		<p class="white-text left">{{ $commission->description }}</p>
	</div>
	<div class="card-action">
		<h5 class="white-text">Price: ${{ $commission->price }}</h5>
		@if($user->id != auth()->user()->id)
			<a class="waves-effect waves-light btn orange btn-large" href="#{{ $id }}_policies">Hire</a>
		@endif
	</div>
</div>
<!-- Gallery Modals -->
<div id="{{ $id }}_zoom_images">
	{{-- Add img tag per image in commission --}}
	<img class="modal lightbox" id="img{{ $commission->id }}1" src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
	<img class="modal lightbox" id="img{{ $commission->id }}2" src="https://udemy-images.udemy.com/course/750x422/394968_538b_7.jpg">
</div>
<!-- Policies Modal -->
<div id="{{ $id }}_policies" class="modal">
	<div class="modal-content">
		<h4 class="center">Client Agreement</h4>
		<hr>
		<p><b> You agree to follow this artist's commission policies: </b></p>
		{{-- Show policies for commission --}}
		<ul>
			<li> No deadline </li>
			<li> At most 2 changes </li>
			<li> No refunds </li>
		</ul>
	</div>
	<div class="modal-footer">
		<hr>
		<a class="modal-action modal-close waves-effect waves-light btn red btn-medium" style="margin-left: 4px;" href="/message/{{ $user->id }}">I Agree</a>
		<button class="modal-action modal-close waves-effect waves-light btn blue btn-medium" style="margin-right: 4px;">Cancel</button>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#{{ $id }}_policies').modal({
			dismissible: false, // Modal can't be dismissed by clicking outside of the modal
			opacity: .8, // Opacity of modal background
			inDuration: 300, // Transition in duration
			outDuration: 200 // Transition out duration
		});
	});
</script>
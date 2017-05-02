<div class="col s12 m9">
	<h5 style="display: inline-block; margin-left: 39%;">Commissions</h5>
	{{-- Verify user is an artist --}}
	@if($user->artist)
		@if (auth()->check() && $user->id == auth()->user()->id)
			<a class="waves-effect waves-light btn blue" style="float: right; margin-top: 10px;" href="/profile/create"><i class="material-icons">note_add</i></a>
		@endif
		{{-- Check user has Commissions --}}
		@if ((count($photography_commissions) == 0) && (count($digital_commissions) == 0) && (count($sketch_commissions) == 0))
			@if (auth()->check() && $user->id == auth()->user()->id)
				<div class="card-panel blue lighten-5 card-content valign center">
					<h5 class="blue-text text-lighten-2">You're not offering any commissions.</h5>
				</div>
			@else
				<div class="card-panel blue lighten-5 card-content valign center">
					<h5 class="blue-text text-lighten-2">This artist isn't offering any commissions at this time.</h5>
				</div>
			@endif
		@else
			{{-- Show Commission Tabs --}}
			<ul id="tabs-swipe" class="tabs tabs-fixed-width" style="margin-top: 10px;">
				@if (count($photography_commissions))
					<li class="tab col s3"><a class="active red white-text" href="#photography">Photography</a></li>
				@endif
				@if (count($digital_commissions))
					<li class="tab col s3"><a class="blue white-text" href="#digital-art">Digital Art</a></li>
				@endif
				@if (count($sketch_commissions))
					<li class="tab col s3"><a class="green white-text" href="#sketch">Sketches</a></li>
				@endif
			</ul>
			{{-- Populate Photography Commissions --}}
			@if (count($photography_commissions))
				<div id="photography" class="col s12 grey darken-4 details" style="border-color:red;">
					@foreach ($photography_commissions as $commission)
						@include('commissions.commission', ['commission' => $commission])
					@endforeach
				</div>
			@endif
			{{-- Populate Digital Commissions --}}
			@if (count($digital_commissions))
				<div id="digital-art" class="col s12 grey darken-4 details" style="border-color:blue;">
					@foreach ($digital_commissions as $commission)
						@include('commissions.commission', ['commission' => $commission])
					@endforeach
				</div>
			@endif
			{{-- Populate Sketch Commissions --}}
			@if (count($sketch_commissions))
				<div id="sketch" class="col s12 grey darken-4 details" style="border-color:green;">
					@foreach ($sketch_commissions as $commission)
						@include('commissions.commission', ['commission' => $commission])
					@endforeach
				</div>
			@endif
		@endif
	@else
		@if (auth()->check() && $user->id == auth()->user()->id)
			<!-- Message for non artist -->
			<div class="card-panel blue lighten-5 card-content valign center">
				<h5 class="blue-text text-lighten-2">You must be an artist to offer commissions.</h5>
				<br>
				<a class="waves-effect waves-light btn blue" href="/profile/becomeArtist">Become an artist</a>
			</div>
		@endif
	@endif
</div>
@extends ('layouts.app')

@section ('content')
	<div class="row">
		<div class="card-panel grey lighten-4 col s12 m6 offset-m3">
			<form method="POST" action="/commissions/{{ $commission->id }}/edit" enctype="multipart/form-data">

				{{ csrf_field() }}

				<h5 class="center">Edit Commission</h5>
				<div class="row">
					<div class="input-field col s12">
						<input id="description" type="text" class="validate" name="description" value="{{ $commission->description }}" required>
						<label for="description">Description</label>
					</div>

					<div class="input-field col s6">
						<select id="type" name="type" class="validate">
							<option value="" disabled required>Choose commission type</option>
							<option value="Photography" {{ $commission->type == 'Photography' ? 'selected' : '' }} required>Photography</option>
							<option value="Digital Art" {{ $commission->type == 'Digital Art' ? 'selected' : '' }} required>Digital Art</option>
							<option value="Sketch" {{ $commission->type == 'Sketch' ? 'selected' : '' }} required>Sketch</option>
						</select>
						<label for="type">Type</label>
					</div>

					<div class="input-field col s6">
						<input id="price" type="number" class="validate" name="price" min="1" step="any" placeholder="0.00" value="{{ $commission->price }}" required>
						<label for="price">Price</label>
					</div>

					<label class="col s10 offset-s1" for="images">Add Commission Images</label>
					<div class="file-field input-field col s10 offset-s1">
						<div class="waves-effect waves-light btn blue">
							<span>Choose Files</span>
							<input id="images" name="images[]" type="file" multiple>
						</div>
						<div class="file-path-wrapper">
							<input class="file-path" type="text" disabled>
						</div>
					</div>
				</div>

				@include ('layouts.errors')
				
				<div class="center">
					<a class="waves-effect waves-light btn red" href="/commissions/{{ $commission->id }}/delete">Delete</a>
					<button type="submit" class="waves-effect waves-light btn blue" style="margin-left: 10px; margin-right: 10px;">Save</button>
					<button type="button" class="waves-effect waves-light btn red" onclick="window.location='/profile'">Cancel</button>
				</div>

				<br>
			</form>
		</div>
	</div>
@endsection
<div class="col s3">
	<div class="card small">
		<div class="card-image">
			<img src="https://help.sketchbook.com/knowledgebase/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png">
			<span class="card-title black-text">{{ $commission->user->name }}</span>
		</div>
		<div class="card-content">
			<p><strong>{{ $commission->type }}: </strong>{{ $commission->description }}</p>
		</div>
		<div class="card-action">
			${{ $commission->price }}
			<a href="commissions/{{ $commission->id }}">More Info</a>
		</div>
	</div>
</div>
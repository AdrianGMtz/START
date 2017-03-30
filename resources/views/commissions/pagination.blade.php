@if ($paginator->hasPages())
	<ul class="pagination center">
		<!-- Previous Link Page -->
		@if ($paginator->onFirstPage())
			<li class="disabled">
				<i class="material-icons">chevron_left</i>
			</li>
		@else
			<li class="waves-effect">
				<a style="padding: 0;" href="{{ $paginator->previousPageUrl() }}" rel="prev">
				<i class="material-icons">chevron_left</i></a>
			</li>
		@endif

		<!-- Pagination Elements -->
		@foreach ($elements as $element)
			<!-- Array Of Links -->
			@if(is_array($element))
				@foreach($element as $page => $url)
					@if ($page == $paginator->currentPage())
						<li class="active">
							<a href="{{ $url }}">{{ $page }}</a>
						</li>
					@else
						<li class="waves-effect">
							<a href="{{ $url }}">{{ $page }}</a>
						</li>
					@endif
				@endforeach
			@endif
		@endforeach
		<!-- Next Link Page -->
		@if($paginator->hasMorePages())
			<li class="waves-effect">
				<a style="padding: 0;" href="{{ $paginator->nextPageUrl() }}" rel="next">
				<i class="material-icons">chevron_right</i></a>
			</li>
		@else
			<li class="disabled">
				<i class="material-icons">chevron_right</i>
			</li>
		@endif
	</ul>
@endif
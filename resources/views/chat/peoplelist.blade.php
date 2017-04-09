<div class="people-list" id="people-list">
	{{-- <div class="search" style="text-align: center">
		<a href="{{url('/home')}}" style="font-size:16px; text-decoration:none; color: white;"><i class="fa fa-user"></i> {{auth()->user()->name}}</a>
	</div> --}}

	<h5 class="center white-text" style="padding: 15px;">Conversations</h5>
	<hr>
	<ul>
		@if (count($threads))
			@foreach($threads as $inbox)
				@if(!is_null($inbox->thread))
					<li class="clearfix">
						<a href="{{route('message.read', ['id'=>$inbox->withUser->id])}}">
						<img class="circle responsive-img" src="https://help.sketchbook.com/knowledgebase/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" alt="profile" style="width: 25%;"/>
						<div class="about">
							<div class="white-text">{{$inbox->withUser->name}}
							</div>
							<div class="status">
								@if(auth()->user()->id == $inbox->thread->sender->id)
									<i class="material-icons">subdirectory_arrow_left</i>
								@else
									<i class="material-icons">subdirectory_arrow_right</i>
								@endif
								<span>{{substr($inbox->thread->message, 0, 20)}}</span>
								@if(!($inbox->thread->is_seen) && auth()->user()->id != $inbox->thread->sender->id)
									<span class="new badge red"></span>
								@endif
							</div>
						</div>
						</a>
					</li>
				@endif
			@endforeach
		@else
			<li class="clearfix">
				<p class="center white-text">You don't have any conversations.</p>
			</li>
		@endif
	</ul>
</div>

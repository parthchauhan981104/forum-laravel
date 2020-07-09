<div class="card-header">
	<div class="d-flex justify-content-between">
		<div>
			<img class="user-img" src="{{Gravatar::src($discussion->author->email)}}" alt="">
    		<span class="ml-2">{{ucwords($discussion->author->name)}}</span>
		</div>
		<div>
			<a href="{{route('discussions.show', $discussion->slug)}}" class="btn btn-info white-text btn-sm">View</a>
		</div>		
	</div>
</div>
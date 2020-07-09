@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Notifications</div>

    <div class="d-flex card-body justify-content-center">
    <ul class="list-group">
    @foreach($notifications as $notification)
		<li class="list-group-item">
			@if($notification->type === 'App\Notifications\NewReplyAdded')
				A new reply was added to your discussion - <strong class="mx-2">{{$notification->data['discussion']['title']}}</strong>
				<a href="{{route('discussions.show', $notification->data['discussion']['slug'])}}" class=" ml-5 float-right btn btn-warning  btn-sm">
					View Discussion
				</a>
			@endif
            @if($notification->type === 'App\Notifications\ReplyMarkedAsBestReply')
                Your reply was marked as the best reply by the author of the discussion - <strong class="mx-2">{{$notification->data['discussion']['title']}}</strong>
                <a href="{{route('discussions.show', $notification->data['discussion']['slug'])}}" class=" ml-5 float-right btn btn-warning  btn-sm">
                    View Discussion
                </a>
            @endif
		</li>
    @endforeach
    </ul>
    </div>
</div>
@endsection

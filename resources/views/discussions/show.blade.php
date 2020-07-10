@extends('layouts.app')

@section('content')

<div class="card">
	@include('partials.discussion-header')

    <div class="card-body">
    	<div class="text-center">
    		<h1><strong>{{$discussion->title}}</strong></h1>
    	</div>
    	<hr><hr><br>
    	{!! $discussion->content !!}
        <br><br>
    </div>
    <hr>

@php
  $bestId = 0;  //to know if there is a best reply
@endphp

@if($discussion->bestReply)
    @php
      $bestId = $discussion->bestReply->id;  
    @endphp
    <div class="card bg-success text-white border-danger mx-1 my-1">
        <div class="card-header">
            
            <div class="d-flex justify-content-between">
                <div class="my-auto">
                    <img class="user-img" src="{{Gravatar::src($discussion->bestReply->user->email)}}" alt="">
                    <span class="ml-2">{{ucwords($discussion->bestReply->user->name)}}</span>
                </div>
                <div class="text-center">
                    <strong class="">Best Reply</strong>
                    <h6 class="">{{$discussion->bestReply->created_at}}</h6>
                </div> 
                @auth
                @if(auth()->user()->id === $discussion->user_id) 
                <div class="my-auto">
                    <form action="{{route('discussions.unmark-best-reply', ['discussion' => $discussion->slug, 'reply' => $discussion->bestReply->id])}}" method="post">
                        @csrf

                        <button type="submit" class="my-auto btn btn-sm btn-danger">
                            Unmark as best reply
                        </button>
                    </form>
                </div>
                @endif
                @endauth
            </div>
        </div>
        <div class="card-body text-center">
            {!! $discussion->bestReply->content !!}
        </div>
        <div class="d-flex card-footer justify-content-between">
            @auth
            <div class="my-auto">
            @if($discussion->bestReply->isLikedByAuthUser())
                <form action="{{route('reply.unlike', ['reply' => $discussion->bestReply->id])}}" method="post">
                    @csrf
                    
                    <button type="submit" class="btn btn-danger btn-sm my-auto">
                        Unlike
                    </button>
                </form>
            @else
                <form action="{{route('reply.like', ['reply' => $discussion->bestReply->id])}}" method="post">
                    @csrf
                    
                    <button type="submit" class="btn btn-primary btn-sm my-auto">
                        Like
                    </button>
                </form>
            @endif
            </div>
            @endauth
            <div class="my-auto">
                <span class="badge ml-2 my-auto">{{$discussion->bestReply->likes->count() }}
                    Likes
                </span>
            </div>
        </div>
    </div>
@endif
</div>

  <br><br><hr>


<br>

<div class="card my-3">
    <div class="card-header">
        Add a reply
    </div>

    <div class="card-body">
        @auth
        <form action="{{route('replies.store', $discussion->slug)}}" method="post">
            @csrf
            <input type="hidden" name="reply" id="reply">
            <trix-editor input="reply"></trix-editor>
            <button type="submit" class="btn float-right btn-primary btn-sm mt-3">
              Post
            </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="w-100" class="btn btn-primary mb-3">
          Sign in to add a reply
        </a>
        @endauth
    </div>
</div>


<div>

    @foreach($discussion->replies()->orderBy('created_at', 'desc')->paginate(3) as $reply)
        @if($bestId !== $reply->id)
            <div class="card my-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img class="user-img" src="{{Gravatar::src($reply->user->email)}}" alt="">
                            <span class="ml-2">{{ucwords($reply->user->name)}}</span>
                        </div>
                        <div class="my-auto">
                            <h6 class="my-auto">{{$reply->created_at}}</h6>
                        </div> 
                        @auth
                        @if(auth()->user()->id === $discussion->user_id) 
                        <div class="my-auto">
                            <form action="{{route('discussions.mark-best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id])}}" method="post">
                                @csrf

                                <button type="submit" class="my-auto btn btn-sm btn-success">
                                    Mark as best reply
                                </button>
                            </form>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
                <div class="text-center card-body">
                    {!! $reply->content !!}
                </div>
                <div class="d-flex card-footer justify-content-between">
                    @auth
                    <div class="my-auto">
                    @if($reply->isLikedByAuthUser())
                        <form action="{{route('reply.unlike', ['reply' => $reply->id])}}" method="post">
                            @csrf
                            
                            <button type="submit" class="btn btn-danger btn-sm my-auto">
                                Unlike
                            </button>
                        </form>
                    @else
                        <form action="{{route('reply.like', ['reply' => $reply->id])}}" method="post">
                            @csrf
                            
                            <button type="submit" class="btn btn-primary btn-sm my-auto">
                                Like
                            </button>
                        </form>
                    @endif
                    </div>
                    @endauth
                    <div class="my-auto">
                        <span class="badge ml-2 my-auto">{{$reply->likes->count() }}
                            Likes
                        </span>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    {{$discussion->replies()->paginate(3)->links() }}

</div>

@endsection

@section('scripts')
{{-- Trix editor for filling stylized content --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
@endsection('scripts')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
@endsection('css') 

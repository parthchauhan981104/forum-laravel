@extends('layouts.app')

@section('content')

<div class="card h-100">
	@include('partials.discussion-header')

    <div class="card-body">
    	<div class="card-body">
	    	<div class="text-center">
	    		<strong>{{$discussion->title}}</strong>
	    	</div>
	    </div>
    	<hr>
    	{!! $discussion->content !!}
    </div>
</div>
@endsection

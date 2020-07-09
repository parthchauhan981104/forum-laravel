@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="d-flex card-body justify-content-center">
        <a href="{{ route('discussions.index') }}" style="width: 100%" class="btn btn-warning w-50 my-2">
		  See discussions
		</a>
    </div>
</div>
@endsection

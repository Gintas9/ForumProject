@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    @if(Auth::user() == $user)
    <div class="container">
       @if(!\App\Http\Controllers\ProfileController::checkNotif())
        <h4>There are no notifications :)</h4>
        @else
        <h1>Notifications:</h1>
        @foreach($posts as $post)
            @if(\App\Http\Controllers\ProfileController::isFirstLike($post->id))
                  <h5>Post {{$post->title}} in topic {{\App\Http\Controllers\ProfileController::getTName($post->tid)}} got first like from user -
                  {{\App\Http\Controllers\ProfileController::whoLikedFirst($post->id)}}!
                  At: {{\App\Http\Controllers\ProfileController::whenLikedFirst($post->id)}}
                  <h5>
            @endif         
        @endforeach
        @foreach($posts as $post)
            @if(\App\Http\Controllers\ProfileController::isMilestone($post->id))
                  <h5>Post: {{$post->title}} in topic {{\App\Http\Controllers\ProfileController::getTName($post->tid)}} reached {{\App\Http\Controllers\ProfileController::likeNum($post->id)}} likes!<h5>
            @endif         
        @endforeach
        @endif
    </div>

  @else
  
  @endif

@endif
@endsection

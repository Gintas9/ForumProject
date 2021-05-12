@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    <div class="container">

        <div class="col-md-8">

         <div class="container">
         @if(!\App\Http\Controllers\PostController::numLikedToday())
            <h5 class="display-4">No rising posts today</h5>
         @else
            
             <h5 class="display-4">Most liked post of today</h5>
             <h6> Post: {{\App\Http\Controllers\PostController::getRisingTitle()}}</h6>
             <h6> In Topic: {{\App\Http\Controllers\PostController::getRisingTopicName()}}</h6>
             <h6> Post Owner: {{\App\Http\Controllers\PostController::getRisingOwner()}}</h6>
             <h6> Total Likes: {{\App\Http\Controllers\PostController::likeNum()}}</h6>
             <a class="btn btn-success" href="{{route('posts.show', \App\Http\Controllers\PostController::mostLikedToday())}}">Open Post</a>

         @endif

         </div>


                    

                
             
    </div>
   
@endif
@endsection

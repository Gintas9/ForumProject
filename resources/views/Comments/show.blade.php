@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    <div class="container">

        <div class="col-md-8">

                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Comment</h1>
                        <hr>
                        <p class="lead">Post : {{$post->title}}</p>
                        <p class="lead">Post Text : {{$post->text}}</p>
                        <p class="lead">Your comment : {{$comment->text}}</p>
                        <p class="lead">Time : {{$comment->created_at}}</p>

                        <a href="{{route('comments.edit',$comment)}}" class="btn btn-warning">Edit Comment</a>
                    </div>
                    @if(!\App\Http\Controllers\LikedCommentController::isCommentLiked($comment))
                        <form action="{{route('likeCommentshow',['post'=>$post,'comment'=>$comment])}}" method="POST">
                            @method('POST')
                            @csrf
                            <button class="btn btn-primary">Like</button>
                        </form>
                    @else

                        <form action="{{route('unlikeCommentshow',['post'=>$post,'comment'=>$comment]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Unlike</button>
                        </form>

                    @endif
                    <span class="badge rounded-pill bg-danger">Likes: {{\App\Http\Controllers\LikedCommentController::commentLikeCount($comment)}}</span>
                </div>
        </div>
@endif
@endsection

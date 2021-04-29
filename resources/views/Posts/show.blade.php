@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
@if(!$theme->blocked)
    <div class="container">

        <div class="col-md-8">

            @if( \App\Http\Controllers\ModsController::isUserPostCreator($post->id) || \App\Http\Controllers\ModsController::isUserMod($post->tid))

                <a href="{{route("posts.edit",$post)}}" class="btn btn-warning">Edit Post</a>

                <form action="{{route('posts.destroy',$post)}}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button class="btn btn-danger">Delete</button>
                </form>
            @endif
                <br>
                <br>
                <br>
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">{{$post->title}}</h1>
                        <hr>
                        <p class="lead">{{$post->text}}</p>
                    </div>
                </div>
                <h6 class="display-6"> Comments </h6>
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                     @foreach($comments as $comment)
                        @if(Auth::user()->id == $comment->uid)
                            <a href="{{route('comments.show', $comment)}}">
                            <h8 class="display-8">{{$comment->text}} |  </h8>                        
                            <h8 class="display-8">{{\App\Http\Controllers\CommentController::getName($comment->uid)}}</h8>
                            <br>
                            </a>
                        @else
                            <h8 class="display-8">{{$comment->text}} |  </h8>
                            <h8 class="display-8">{{\App\Http\Controllers\CommentController::getName($comment->uid)}}</h8>
                            <br>
                        @endif 
                      @endforeach
                    </div>
                </div>


                <br>
                <br>
        <form method="POST" action="{{route('comments.store')}}">
                {{csrf_field()}}
            <div class="col-md-8">
                <h5 class="display-6"> Write a comment: </h5>
                <div class="input-group input-group-lg">
                    <input name="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                    <input type="hidden" name="pid" value="{{$post->id}}" />
                </div>
            </div>
            <br>
            <div class="col-md-8">
                <input type="submit" value="Submit" class="btn btn-primary" href=""></input>
            </div>
        </form>

    </div>
    @else
    <h1>Theme is blocked by administrator</h>
    @endif

@endif
@endsection

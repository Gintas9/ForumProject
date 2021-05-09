@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
@if(!$theme->blocked)
    <div class="container">

        <div class="col-md-8">

            @if( \App\Http\Controllers\ModsController::isUserPostCreator($post->id) || \App\Http\Controllers\ModsController::isUserMod($post->tid) || \App\Models\Theme::isUserThemeCreator($theme))

                <a href="{{route("posts.edit",$post)}}" class="btn btn-warning">Edit Post</a>

                <form onsubmit="return confirm('Do you really want to delete this post?');" action="{{route('posts.destroy',$post)}}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button class="btn btn-danger">Delete</button>

                </form>

            @endif


                <br>
                <br>
                <br>
                <div class="jumbotron jumbotron-fluid">

                    By <a href="{{route('profiles.show',\App\Models\Post::getUserByPost($post))}}">{{\App\Models\Post::getUserByPost($post)->name}}</a>
                    @if(!\App\Http\Controllers\LikedPostController::isPostLiked($post))
                        <form action="{{route('likePost',$post) }}" method="POST">
                            @method('POST')
                            @csrf
                            <button class="btn btn-primary">Like</button>
                        </form>
                    @else

                        <form action="{{route('unlikePost',$post) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Unlike</button>
                        </form>

                    @endif

                        <span class="badge rounded-pill bg-danger">Likes: {{\App\Http\Controllers\LikedPostController::postLikeCount($post)}}</span>


                    <div class="container">
                        <h1 class="display-4">{{$post->title}}</h1>
                        <hr>
                        <p class="lead">{{$post->text}}</p>

                    </div>
                        <br>


                </div>


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
                    @if(count($errors))
                        <div class="form-group">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </form>
                <h6 class="display-6"> Comments </h6>
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        @foreach($comments as $comment)

                        <li class="list-group-item">

                            <a href="{{route('profiles.show', \App\Models\User::getUser($comment->uid))}}">{{\App\Models\User::getUser($comment->uid)->name}}</a>
                            <hr>
                            {{$comment->text}}
                            <br>
                            <hr>

                            @if(!\App\Http\Controllers\LikedCommentController::isCommentLiked($comment))
                                <form action="{{route('likeComment',['post'=>$post,'comment'=>$comment])}}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <button class="btn btn-primary">Like</button>
                                </form>
                            @else

                                <form action="{{route('unlikeComment',['post'=>$post,'comment'=>$comment]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Unlike</button>
                                </form>

                            @endif
                                <span class="badge rounded-pill bg-danger">Likes: {{\App\Http\Controllers\LikedCommentController::commentLikeCount($comment)}}</span>
                        </li>
                            <br>
                        @endforeach
                    </ul>
                </div>
                <br>
                <br>
    </div>
    @else
    <h1>Theme is blocked by administrator</h>
    @endif

@endif
@endsection

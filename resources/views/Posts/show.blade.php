@extends('layouts.app')
@section('content')
    <div class="container">
        Parodymai

        <div class="col-md-8">

            @if( \App\Http\Controllers\ModsController::isUserCreator($theme->id))

                <a href="{{route("posts.edit",$post)}}" class="btn btn-warning">Edit Post</a>

                <form action="{{route('posts.destroy',$post)}}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button class="btn btn-danger">Delete</button>
                </form>
            @endif
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">{{$post->title}}</h1>
                        <p class="lead">{{$post->text}}</p>
                    </div>
                </div>

    </div>
@endsection

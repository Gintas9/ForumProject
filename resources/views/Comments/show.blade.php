@extends('layouts.app')
@section('content')
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
                </div>
        </div>
                
@endsection

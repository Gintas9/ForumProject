@extends('layouts.app')

@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
<div class="container">

    <div class="row justify-content-center">
        @if(Auth::user()->id == 1)
        <div class="col-md-8">

            <a class="btn btn-primary" href="{{route('superuser')}}">Admin</a>

        </div>

          <div class="col-md-8">

            <a class="btn btn-primary" href="{{route('themes.index')}}">Topics</a>

        </div>
        @else
        <div class="col-md-8">




            <a class="btn btn-primary" href="{{route('themes.index')}}">Topics</a>
            <a class="btn btn-danger" href="">Notifications: 1</a>
            <a class="btn btn-success" href="">Rising Posts</a>
            <a class="btn btn-secondary" href="">Profile</a>

        </div>

        @endif
     


        </div>
    </div>
<div class="row justify-content-center">
    <div class="col-1 justify-content-center">
        <br>
        <br>
            <h1>Posts</h1>
        <br>

    </div>

</div>
<div class="row justify-content-center">



    <div class="col-md-8 col-xl-6 col-sm-12 justify-content-center">
        @foreach($posts as $post)
        <div class="card ">
            <div class="card-body">
                <h2 class="card-title"><a href="{{route('posts.show',$post)}}">{{$post->title}}</a></h2>
                <a href="{{ route('themes.show',\App\Models\Theme::getTheme($post->tid))}}"><p>{{ \App\Models\Theme::getTheme($post->tid)->topicname}}</p></a>
                <p class="card-text">{{substr($post->text,0,50)}}</p>
                By <a href="" class="">{{\App\Models\User::getUser($post->uid)->name }}</a>

            </div>
        </div>
        @endforeach


    </div>

</div>
</div>
@endif
@endsection

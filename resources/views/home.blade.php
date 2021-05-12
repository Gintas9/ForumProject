@extends('layouts.app')

@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
<div class="container">
    <div class="row justify-content-center">

                <div class="row justify-content-right">
                    <div class="col-12">

                        <a class="btn btn-primary" href="{{route('themes.index')}}">Topics</a>
                        <a class="btn btn-danger" href="{{route('notifications',Auth::user()->id )}}">Notifications</a>
                        <a class="btn btn-success" href="{{route('risingpost')}}">Rising Post</a>
                        <a class="btn btn-secondary" href="{{route('profiles.show',Auth::user()->id )}}">Profile</a>
                        @if(Auth::user()->id == 1)   <a class="btn btn-primary" href="{{route('superuser')}}">Admin</a>  @endif

                    </div>

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


                            </div>

                        @if(!\App\Http\Controllers\LikedPostController::isPostLiked($post))
                                <form action="{{route('likePostHome',$post) }}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <button class="btn btn-primary">Like</button>
                                </form>


                            @else

                                <form action="{{route('unlikePostHome',$post) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Unlike</button>
                                </form>

                            @endif

                        </div>
                        <span class="badge rounded-pill bg-danger">Likes: {{\App\Http\Controllers\LikedPostController::postLikeCount($post)}}</span>


                    @endforeach

                    @if(!\App\Http\Controllers\PagesController::AnyPosts())
                            <div class="alert alert-danger" role="alert">
                                No Posts yet! Try Following Some Themes :)
                            </div>
                    @endif
                        {{ $posts->links('pagination::bootstrap-4')}}
                </div>



            </div>

</div>



@endif
@endsection

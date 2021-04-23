@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="col-md-8">

            @if( \App\Http\Controllers\ModsController::isUserCreator($theme->id))

                <a href="{{route('themes.edit',$theme)}}" class="btn btn-warning">Edit Topic</a>



                <form action="{{route('themes.destroy',$theme)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <hr>
                    <br>
                    <button class="btn btn-danger">Delete</button>
                </form>
                <form method="POST" action="{{route('mods.store')}}">
                    {{csrf_field()}}

                    <div class="col-md-8">


                        <div class="input-group">

                            <input type="text" name="uid" class="form-control" placeholder="id" aria-label="With textarea">
                            <input type="text" name="level" class="form-control" placeholder="level" aria-label="With textarea">
                        </div>

                    </div>
                    <div class="col-md-8"><input type="hidden" name="tid" value="{{$theme->id}}" />
                        <input type="submit" value="Add mod" class="btn btn-primary" href="">

                    </div>
                </form>
            @endif
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">{{$theme->topicname}}</h1>
                    <hr>
                    <p class="lead">{{$theme->description}}</p>
                </div>
            </div>

                <br>
                <br>
                <div class="row justify-content-center topics">

                    <form action="{{route('posts.store')}}" method="POST" >
                        @method('POST')
                        @csrf

                                <input type="text" class="form-control" placeholder="Title" name="title">
                                <textarea type="text" class="form-control" placeholder="Text" name="text"></textarea>
                                <input type="hidden" name="uid" value="{{$user->id}}" />
                                <input type="hidden" name="tid" value="{{$theme->id}}" />

                                    <button class="btn btn-danger">create post</button>

                    </form>
                </div>




            <div class="container">
                <h1>Posts</h1>
                <div class="list-group">


                    @foreach($posts as $post)
                        <a href="{{route('posts.show',$post)}}" class="list-group-item list-group-item-action">{{$post->title}}</a>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="list-group">

        </div>


        <div class="container">
            <h1>Mods</h1>
            <div class="list-group">
                @foreach(\App\Http\Controllers\ModsController::getUsersMods($theme->id) as $mod)
                    <a href="" class="list-group-item list-group-item-action">
                        {{\App\Http\Controllers\ModsController::getUserName($mod->uid)}}
                        {{\App\Http\Controllers\ModsController::getMod($mod->uid,$mod->tid)->level}}
                    </a>





                @endforeach
            </div>
        </div>

    </div>

    </div>
@endsection

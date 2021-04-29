@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
@if(!$theme->blocked)
    <div class="container">

        <div class="col-md-8">

            @if( \App\Http\Controllers\ModsController::isUserCreator($theme->id))

                <a href="{{route('themes.edit',$theme)}}" class="btn btn-warning">Edit Topic</a>



                <form action="{{route('themes.destroy',$theme)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <hr>
                    <br>
                    <button class="btn btn-danger">Delete Theme</button>
                </form>
                <form method="POST" action="{{route('mods.store')}}">
                    {{csrf_field()}}

                    <div class="col-md-8">


                        <div class="input-group">


                            <div class="form-group">
                                <label for="sel1">Select list:</label>
                                <select name='uid' class="form-control" id="sel1">

                                    @foreach(\App\Http\Controllers\ModsController::getUsersForMods($theme->id) as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>



                            <label class="checkbox-inline"><input type="radio" name='level' value="1">Level 1</label>
                            <label class="checkbox-inline"><input type="radio" name='level' value="2">Level 2</label>
                            <label class="checkbox-inline"><input type="radio" name='level' value="3">Level 3</label>

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
                <br><br>
                <div class="list-group">

                @if(\App\Models\Post::hasPosts())

                    @foreach($posts as $post)
                        <a href="{{route('posts.show',$post)}}" class="list-group-item list-group-item-action">{{$post->title}}</a>
                    @endforeach
                    @else
                    <div class="alert alert-danger">
                    <h1>No Posts Yet!</h1>
                    </div>
                    @endif

                </div>
                <br><br>
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
    @else
    <h1>Theme is blocked by administrator</h>
    @endif
@endif
@endsection

@extends('layouts.app')
@section('content')
    <div class="container">

        {{$user->name}}
        <div class="col-md-8">
            <a class="btn btn-primary" href="{{route('themes.create')}}">New Theme</a>
        </div>

        <div class="list-group">
            @if(!\App\Models\Theme::hasThemes())
                <div class="alert alert-danger">
                    <h1>No Themes Yet!</h1>
                </div>
            @endif
        @foreach($themes as $theme)
                <a href="{{route('themes.show',$theme)}}" class="list-group-item list-group-item-action ">
                    {{$theme->topicname}}
                </a>
        @endforeach
    </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    <div class="container">

        {{$user->name}}
        <div class="col-md-8">
            <a class="btn btn-primary" href="{{route('themes.create')}}">New Theme</a>
        </div>

        <div class="list-group">
        @foreach($themes as $theme)
            @if(!$theme->blocked)
                <a href="{{route('themes.show',$theme)}}" class="list-group-item list-group-item-action ">
                    {{$theme->topicname}}
                </a>
            @endif
        @endforeach
    </div>
    </div>
@endif
@endsection

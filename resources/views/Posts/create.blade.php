@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    <div class="container">


        {{$user->name}}
        <div class="row justify-content-center topics">

            <form method="POST" action="{{route('posts.store')}}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Title" name="title">
                        <textarea type="text" class="form-control" placeholder="Text" name="text"></textarea>
                        <input type="hidden" name="uid" value="{{$user->id}}" />
                        <input type="hidden" name="tid" value="{{$theme->id}}" />
                        <input type="submit" value="Submit New Post">
                    </div>
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
        </div>
    </div>
@endif
@endsection

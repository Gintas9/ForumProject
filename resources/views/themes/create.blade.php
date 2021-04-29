@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    <div class="container">


        {{$user->name}}
        <form method="POST" action="{{route('themes.store')}}">
            {{csrf_field()}}
        <div class="col-md-8">

            <div class="input-group input-group-lg">

                <input name="topicname" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
            </div>


        </div>
        <div class="col-md-8">


            <div class="input-group">

                <textarea name="description" class="form-control" aria-label="With textarea"></textarea>
            </div>

        </div>
        <div class="col-md-8">
            <input type="submit" value="Submit" class="btn btn-primary" href=""></input>
        </div>
        </form>
    </div>
    @endif
@endsection

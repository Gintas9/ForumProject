@extends('layouts.app')
@section('content')
    <div class="container">
        Vuotatau

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
            <input type="submit" value="Submit" class="btn btn-primary" href="">Submit</input>
        </div>
        </form>
    </div>
@endsection

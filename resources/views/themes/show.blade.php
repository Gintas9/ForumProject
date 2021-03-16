@extends('layouts.app')
@section('content')
    <div class="container">
        Parodymai

        <div class="col-md-8">


            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">{{$theme->topicname}}</h1>
                    <p class="lead">{{$theme->description}}</p>
                </div>
            </div>


        </div>

        <div class="list-group">

        </div>
    </div>
@endsection

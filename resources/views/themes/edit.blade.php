@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    <main>

        <div class="container">

            <div class="row justify-content-center topics">

                <form method="POST" action="{{route('themes.update',$theme)}}">
                    @method('PUT') @csrf

                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Title" name="topicname" value="{{$theme->topicname}}">
                            <input type="text" class="form-control" placeholder="Text" name="description" value="{{$theme->description}}">
                            <input type="hidden" class="form-control" placeholder="Text" name="tid" value="{{$theme->id}}">

                            <input type="submit" value="Edit Topic">
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
    </main>
@endif
@endsection

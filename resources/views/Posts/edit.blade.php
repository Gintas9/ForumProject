@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    <main>

        <div class="container">

            <div class="row justify-content-center topics">

                <form action="{{route('posts.update',$post)}}" method="POST">
                    @csrf
                    @method('PUT')


                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Title" name="title" value="{{$post->title}}">
                            <input type="text" class="form-control" placeholder="Text" name="text" value="{{$post->text}}">


                            <button class="btn btn-danger">edit post</button>
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

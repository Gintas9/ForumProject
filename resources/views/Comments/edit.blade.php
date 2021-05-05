@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    <main>

        <div class="container">

            <div class="row justify-content-center topics">

                <form action="{{route('comments.update',$comment)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Title" name="text" value="{{$comment->text}}">
                            <button class="btn btn-warning">Edit Comment</button>
                        </div>
                    </div>

                </form>
                 <form onsubmit="return confirm('Do you really want to delete this comment?');" action="{{route('comments.destroy',$comment)}}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button class="btn btn-danger">Delete</button>
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

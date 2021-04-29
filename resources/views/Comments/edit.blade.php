@extends('layouts.app')
@section('content')
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
                 <form action="{{route('comments.destroy',$comment)}}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button class="btn btn-danger">Delete</button>
                </form>


            </div>
        </div>
    </main> 
@endsection

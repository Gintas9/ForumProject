@extends('layouts.app')
@section('content')
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
                </form>


            </div>
        </div>
    </main>
@endsection

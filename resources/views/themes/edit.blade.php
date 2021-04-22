@extends('layouts.app')
@section('content')
    <main>

        <div class="container">

            <div class="row justify-content-center topics">

                <form  action="{{route('themes.update',$theme)}}">
                    @method('PUT') @csrf

                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Title" name="topicname" value="{{$theme->topicname}}">
                            <input type="text" class="form-control" placeholder="Text" name="description" value="{{$theme->description}}">
                            <input type="hidden" class="form-control" placeholder="Text" name="tid" value="{{$theme->id}}">

                            <input type="submit" value="Edit Topic">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@extends('layouts.app')
@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
    @if(Auth::user() == $user)
    <div class="container">
        <div class="col-md-4">
            <h2>Profile Details </h2>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Name
                <span class="badge badge-secondary badge-pill">{{$user->name}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Email
                <span class="badge badge-secondary badge-pill">{{$user->email}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Created At:
                <span class="badge badge-secondary badge-pill">{{$user->created_at}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Updated At:
                <span class="badge badge-secondary badge-pill">{{$user->updated_at}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Number of topics created:
                <span class="badge badge-secondary badge-pill">{{\App\Http\Controllers\ProfileController::getTcreated($user->id)}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Number of posts created:
                <span class="badge badge-secondary badge-pill">{{\App\Http\Controllers\ProfileController::getPcreated($user->id)}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Number of topics followed:
                <span class="badge badge-secondary badge-pill">{{\App\Http\Controllers\ProfileController::getFTopic($user->id)}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Total followers:
                <span class="badge badge-secondary badge-pill">{{\App\Http\Controllers\ProfileController::getTFoll($user->id)}}</span>
              </li>
            </ul>

                

                <form onsubmit="return confirm('Do you really want to delete your account?');" action="{{route('profiles.destroy',$user->id)}}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button class="btn btn-danger">Delete account</button>    
                </form>
                <a href="{{route("profiles.edit",$user->id)}}" class="btn btn-warning">Change Email/Password</a>

        </div>
        <br>
        <br>
        <br>
        <br>
       <h5 class="display-6"> Your Themes: </h5>
       <table class="table">
          <thead>
            <tr>
              <th scope="col">Theme Id</th>
              <th scope="col">Theme name</th>
              <th scope="col">Created At</th>
              <th scope="col">Followers</th>
              <th scope="col">Open</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            @foreach($themes as $theme)
              <th scope="row">{{$theme->id}}</th>
              <td>{{$theme->topicname}}</td>
              <td>{{$theme->created_at}}</td>
              <td>{{\App\Http\Controllers\ProfileController::getTFoll($user->id)}}</td>
              <td> <a href="{{route("themes.show",$theme)}}" class="btn btn-primary">Open topic</a> </td>
            </tr>
            @endforeach
          </tbody>
       </table>
        <br>
        <br>
        <br>
        <br>
       <h5 class="display-6"> Your Posts: </h5>
       <table class="table">
          <thead>
            <tr>
              <th scope="col">Post Id</th>
              <th scope="col">Title</th>
              <th scope="col">Theme name</th>
              <th scope="col">Created At</th>
              <th scope="col">Open</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            @foreach($posts as $post)
              <th scope="row">{{$post->id}}</th>
              <td>{{$post->title}}</td>
              <td>{{\App\Http\Controllers\ProfileController::getTName($post->tid)}}</td>
              <td>{{$post->created_at}}</td>
              <td> <a href="{{route("posts.show",$post)}}" class="btn btn-primary">Open post</a> </td>
            </tr>
            @endforeach
          </tbody>
       </table>
        <br>
        <br>
        <br>
        <br>
        <h5 class="display-6"> Your Comments: </h5>
       <table class="table">
          <thead>
            <tr>
              <th scope="col">Post Id</th>
              <th scope="col">Post Title</th>
              <th scope="col">Comment Created At</th>
              <th scope="col">Open</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            @foreach($comments as $comment)
              <th scope="row">{{$comment->pid}}</th>
              <td>{{\App\Http\Controllers\ProfileController::getPTitle($comment->pid)}}</td>
              <td>{{$comment->created_at}}</td>
              <td> <a href="{{route("comments.show",$comment)}}" class="btn btn-primary">Open comment</a> </td>
            </tr>
            @endforeach
          </tbody>
       </table>

    </div>

  @else
      <div class="container">
        <div class="col-md-4">
            <h2>Profile Details </h2>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Name
                <span class="badge badge-secondary badge-pill">{{$user->name}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Number of topics created:
                <span class="badge badge-secondary badge-pill">{{\App\Http\Controllers\ProfileController::getTcreated($user->id)}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Number of posts created:
                <span class="badge badge-secondary badge-pill">{{\App\Http\Controllers\ProfileController::getPcreated($user->id)}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Number of topics followed:
                <span class="badge badge-secondary badge-pill">{{\App\Http\Controllers\ProfileController::getFTopic($user->id)}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Total followers:
                <span class="badge badge-secondary badge-pill">{{\App\Http\Controllers\ProfileController::getTFoll($user->id)}}</span>
              </li>
            </ul>
        </div>
      </div>
  @endif

@endif
@endsection

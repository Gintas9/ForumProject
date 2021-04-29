@extends('layouts.app')
@section('content')
    <div class="container">
    @if(Auth::user()->id == 1)
       <h5 class="display-6"> Themes: </h5>
       <table class="table">
          <thead>
            <tr>
              <th scope="col">Theme Id</th>
              <th scope="col">Theme name</th>
              <th scope="col">Owner</th>
              <th scope="col">Owner Id</th>
              <th scope="col">Created At</th>
              <th scope="col">Blocked</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            @foreach($themes as $theme)
              <th scope="row">{{$theme->id}}</th>
              <td>{{$theme->topicname}}</td>
              <td>{{\App\Http\Controllers\CommentController::getName($theme->owner)}}</td>
              <td>{{$theme->owner}}</td>
              <td>{{$theme->created_at}}</td>

                  <td>
                      @if($theme->blocked)
                      Yes
                      @else
                      No
                     @endif
                  </td>
                  <td>
                      <form action="{{route('superusertid',$theme) }}" method="POST">
                          @method('POST')
                          @csrf
                          <button class="btn btn-danger">Block/Unblock</button>
                      </form>
                  </td>
            </tr>
            @endforeach
          </tbody>
       </table>


       <h5 class="display-6"> Users: </h5>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">User Id</th>
              <th scope="col">User name</th>
              <th scope="col">Email</th>
              <th scope="col">Date Joined</th>
              <th scope="col">Blocked</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            @foreach($users as $user)
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->created_at}}</td>
              <td>
                      @if($user->blocked)
                      Yes
                      @else
                      No
                     @endif
              </td>
              <td>
                <form action="{{route('superuseruid',$user) }}" method="POST">
                    @method('POST')
                    @csrf
                    <button class="btn btn-danger">Block/Unblock</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
       </table>

     </div>
     @else
     <h1>You are not admin<h1>
     @endif
@endsection

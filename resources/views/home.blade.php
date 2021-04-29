@extends('layouts.app')

@section('content')
@if(Auth::user()->blocked)
    <h1>You Are Blocked By Admin<h1>
@else
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::user()->id == 1)
        <div class="col-md-8">

            <a class="btn btn-primary" href="{{route('superuser')}}">Admin</a>

        </div>

          <div class="col-md-8">

            <a class="btn btn-primary" href="{{route('themes.index')}}">Topics</a>

        </div>
        @else
        <div class="col-md-8">

            <a class="btn btn-primary" href="{{route('themes.index')}}">Topics</a>

        </div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

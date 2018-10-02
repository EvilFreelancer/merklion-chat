@extends('layouts.app')

@section('content')
    <div class="container" id="app-chat">
        <input type="hidden" ref="username" value="{{ Auth::user()->name }}">
        <div class="card">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                You are logged in!
            </div>
        </div>
    </div>
@endsection

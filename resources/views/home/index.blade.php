@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Main Page') }}:
                </div>

                @auth
                    @if(Auth::user()->profile_picture)
                    <img src="{{ asset(sprintf('images/%s', Auth::user()->profile_picture)) }}">
                    @endif
                    @if(Auth::user()->garage_picture)
                    <img src="{{ asset(sprintf('images/%s', Auth::user()->garage_picture)) }}">
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection

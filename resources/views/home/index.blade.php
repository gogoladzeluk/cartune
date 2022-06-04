@extends('layouts.app')

@section('content')
    <div class="container" style="position: absolute;top: 10%;bottom: 0px;left:0px;right:0px;z-index: -1;">
        <img src="{{ asset('files/landing_page_background.jpg') }}" style="width: 100%; margin-top: -50px;">
        <a href="{{ route('mechanics.index') }}" class="btn btn-warning" style="
            position: absolute;
            left: 6%;
            bottom: 5%;
            color: white;
            padding: 5px 20px;
            font-size: 35px;
            font-weight: bold;
            border-radius: 25px;
            z-index: 1">
            {{ __('Search') }}</a>
    </div>
@endsection

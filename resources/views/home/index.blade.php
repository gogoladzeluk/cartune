@extends('layouts.app')

@section('content')
    <div class="landing-image-landscape" style="width: 100%; height: 100%; margin-top: -70px;">
        <a href="{{ route('mechanics.index') }}">
            <img src="{{ asset('files/landing_landscape.png') }}" style="width: 100%;">
        </a>
    </div>
    <div class="landing-image-portrait" style="width: 100%; height: 100%; margin-top: -50px;">
        <a href="{{ route('mechanics.index') }}">
            <img src="{{ asset('files/landing_portrait.png') }}" style="width: 100%;">
        </a>
    </div>
@endsection

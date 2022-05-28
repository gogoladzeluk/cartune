@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('register_user') }}">{{ __('User') }}</a>
        <a href="{{ route('register_mechanic') }}">{{ __('Mechanic') }}</a>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <a href="{{ route('register_user') }}" class="btn-lg btn-primary">{{ __('User') }}</a>
            <a href="{{ route('register_mechanic') }}" class="btn-lg btn-primary">{{ __('Mechanic') }}</a>
        </div>
    </div>
@endsection

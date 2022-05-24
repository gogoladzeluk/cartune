@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('register_user') }}">user</a>
        <a href="{{ route('register_mechanic') }}">mechanic</a>
    </div>
@endsection

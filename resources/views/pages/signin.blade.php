@extends('layouts.auth')
@section('content')
    @include('partials.form', [
        'route' => null,
        'method' => 'POST',
        'action' => 'Login'
    ])
@endsection
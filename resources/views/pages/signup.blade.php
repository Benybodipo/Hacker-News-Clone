@extends('layouts.auth')
@section('content')
    @include('partials.form', [
        'route' => null,
        'method' => 'POST',
        'action' => 'Create Account'
    ])
@endsection
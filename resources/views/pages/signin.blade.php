@extends('layouts.auth')
@section('content')
    @include('partials.form', [
        'route' => route('post.signin'),
        'method' => 'POST',
        'action' => 'Login'
    ])
@endsection

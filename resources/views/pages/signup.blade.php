@extends('layouts.auth')
@section('content')
    @include('partials.form', [
        'route' => route('post.signup'),
        'method' => 'POST',
        'action' => 'Create Account'
    ])
@endsection

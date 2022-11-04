@extends('layouts.main')
@section('content')
    <div class="row">
        @for ($i = 0; $i < 5; $i++)
            <div class="col-lg-6 mt-3">
                @include('partials.cart', ['index' => ($i + 1)])
            </div>
        @endfor
    </div>
@endsection
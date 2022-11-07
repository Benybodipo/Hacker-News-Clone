@extends('layouts.main')
@section('content')
    <div class="row">
        @foreach ($items as $index => $item)
            <div class="col-lg-6 mt-3">
                @include('partials.cart', ['item' => $item, 'index' => ($index+1)])
            </div>
        @endforeach
    </div>
@endsection
@extends('layouts.main')
@section('content')
    <div class="row">
        @foreach ($items as $index => $item)
            <div class="col-lg-6 mt-3">
                @include('partials.cart', ['item' => (object)$item, 'index' => ((integer)$index+1)])
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center pt-4">
            {!! $items->links() !!}
        </div>
    </div>
@endsection
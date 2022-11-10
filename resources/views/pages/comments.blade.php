@extends('layouts.main')
@section('content')
    <div class="row">
        @foreach ($comments as $comment)
            @php($parent = \App\Models\Item::where('original_id', $comment->from)->first())
           
            <div class="col-sm-12 comment rounded shadow-sm">
                <p class="heading">
                    <small>
                        <a href="">
                            <i class="fa-solid fa-user"></i>
                            {{$comment->by}}
                        </a>
                    </small>
                    <small>
                        <a href="">
                            <i class="fa-regular fa-calendar"></i> 
                            {{\Carbon\Carbon::parse((integer)$comment->time)->diffForHumans()}}
                        </a>
                    </small>
                    <small>
                        <a href="{{route('comment', [$comment->parent])}}">
                            <i class="fa-solid fa-diagram-project"></i>
                            Parent
                        </a>
                    </small>
                    <small>
                        On: 
                        <a href="{{route('news', [$comment->from])}}">
                            {{($parent) ? $parent->title: ''}}
                        </a>
                    </small>
                </p>
                <div class="coment-body">
                    {!! $comment->text !!}
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center pt-4">
            {!! $comments->links() !!}
        </div>
    </div>
@endsection
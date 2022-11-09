@extends('layouts.main')
@section('content')
    @php($parent = \App\Models\Item::where('original_id', $comment->from)->first())
    {{dd($parent)}}

    <div class="row">
        <p class="heading horizontal-nav text-sm">
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
                <a href="{{route('news', [$comment->from])}}">
                    <i class="fa-solid fa-eye-slash"></i> Context
                </a>
            </small>
            <small>
                <a href="">
                    Next
                    <i class="fa-sharp fa-solid fa-forward"></i> 
                </a>
            </small>
            <small>
                On: 
                <a href="">
                    {{($parent) ? $parent->title: ''}}
                </a>
            </small>
        </p>
        <div class="comment-text">
            {!! $comment->text!!}
        </div>
        <div class="col-sm-10">
            <div class="form-floating mb-3">
                <textarea class="form-control" style="height: 100px;"></textarea>
            </div>
            <button class="btn btn-sm custom-btn">
                Replay
            </button>
        </div>
    </div>
    <div class="row">
        @foreach ($parent->comments as $comment)
            @if((is_array($comment) || is_object($comment)) && !is_null($comment)) 
                <x-comment-item :comment="$comment" />
            @endif
        @endforeach
    </div>
@endsection
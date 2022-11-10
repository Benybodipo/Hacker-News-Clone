@extends('layouts.main')
@section('content')
    @php($parent = \App\Models\Item::where('original_id', $comment->from)->first())

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
            <form action="{{route('comment-on', [3])}}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="text" style="height: 100px;"></textarea>
                    @error('text') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                @auth
                    <input type="hidden" name="parent" value="{{$comment->original_id}}">
                    <input type="hidden" name="from" value="{{$comment->from}}">
                    <input type="hidden" name="by" value="{{auth()->user()->username}}">
                    <button class="btn btn-sm custom-btn" type="submit">
                        Replay
                    </button>
                @else
                    <a href="{{route('get.signin')}}" class="btn btn-sm custom-btn">Replay</a>
                @endauth                
            </form>
        </div>
    </div>
    <div class="row">
        @foreach ($comment->comments as $child)
            @if((is_array($child) || is_object($child)) && !is_null($child))
                <x-comment-item :comment="$child" />
            @endif
        @endforeach
    </div>
@endsection

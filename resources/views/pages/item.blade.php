@extends('layouts.main')
@section('content')
{{-- {{dd($item)}} --}}
    <div class="row">
        <div class="col-sm-10">
            <div class="comment p-0">
                <h6>
                    <a href="{{$item->url}}"> {{$item->title}} </a>
                    {{-- <small class="text-muted">({{ substr(explode('/',$item->url)[2], (strpos(explode('/',$item->url)[2], '.') + 1)) }})</small> --}}
                </h6>
                <p class="heading">
                    <small>
                        {{$item->score}} points by
                        <a href="{{route('user', [$item->by])}}">
                            <i class="fa-solid fa-user"></i>
                            {{$item->by}}
                        </a>
                    </small>
                    <small>
                        <a href="">
                            <i class="fa-regular fa-calendar"></i>
                            {{\Carbon\Carbon::parse((integer)$item->time)->diffForHumans()}}
                        </a>
                    </small>
                    <small>
                        <a href="">
                            <form action="{{route('action', [$item->original_id, 2])}}" method="POST" 
                                style="display: inline-block;"
                                >
                                @csrf
                                <button type="submit" style="background: none; border: none; color: gray;">
                                    <i class="fa-solid fa-eye-slash"></i> Hide
                                </button>
                            </form>
                        </a>
                    </small>

                    <small>
                        <a href="">
                            Past
                        </a>
                    </small>
                    <small>
                        @auth
                            <a >
                                <form action="{{route('action', [$item->original_id, 1])}}" method="POST" 
                                    style="display: inline-block;"
                                    >
                                    @csrf
                                    <button type="submit" style="background: none; border: none; color: gray;">
                                        <i class="fa-solid fa-heart"></i>
                                        Favourite
                                    </button>
                                </form>
                            </a>
                        @else
                            <a href="{{ route('get.signin')}}">
                                <i class="fa-solid fa-heart"></i>
                                Favourite
                            </a>
                        @endauth
                    </small>
                    <small>
                        <a href="">
                            {{$item->descendants}}
                            Comments
                        </a>
                    </small>
                </p>
            </div>
        </div>
        @if ($item->text)
            <div class="col-sm-12">
                {!! $item->text !!}
            </div>
        @endif
        <div class="col-sm-8">
            <form action="{{route('comment-on', [2])}}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <textarea name="text" class="form-control" style="height: 100px;"></textarea>
                    @error('text') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                @auth
                    <input type="hidden" name="parent" value="{{$item->original_id}}">
                    <input type="hidden" name="from" value="{{$item->original_id}}">
                    <input type="hidden" name="by" value="{{auth()->user()->username}}">
                    <button class="btn btn-sm custom-btn" type="submit">
                        Add comment
                    </button>
                @else
                    <a href="{{route('get.signin')}}" class="btn btn-sm custom-btn">Add comment</a>
                @endauth
            </form>
        </div>
    </div>
    <div class="row">
        @if ($item->children)
            @foreach ($item->children as $comment)
                @if((is_array($comment) || is_object($comment)) && !is_null($comment))
                    <x-comment-item :comment="$comment" />
                @endif
            @endforeach
        @endif
    </div>
@endsection

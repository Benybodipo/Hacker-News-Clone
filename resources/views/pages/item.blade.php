@extends('layouts.main')
@section('content')
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
                            <i class="fa-solid fa-eye-slash"></i>
                            Hide
                        </a>
                    </small>
                    
                    <small>
                        <a href="">
                            Past
                        </a>
                    </small>
                    <small>
                        <a href="">
                            <i class="fa-solid fa-heart"></i>
                            Favourite
                        </a>
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
            <div class="form-floating mb-3">
                <textarea class="form-control" style="height: 150px;"></textarea>
                <label for="floatingTextarea" >Comments</label>
            </div>
            <button class="btn custom-btn">
                Add comment
            </button>
        </div>
    </div>
    <div class="row">
        @foreach ($item->children as $comment)
            @if((is_array($comment) || is_object($comment)) && !is_null($comment)) 
                <x-comment-item :comment="$comment" />
            @endif
        @endforeach
    </div>
@endsection
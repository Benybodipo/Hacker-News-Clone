@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-10">
            <div class="comment">
                <h6>
                    <a href="{{$item->url}}"> {{$item->title}} </a>
                    <small class="text-muted">({{ substr(explode('/',$item->url)[2], (strpos(explode('/',$item->url)[2], '.') + 1)) }})</small>
                </h6>
                <p class="heading">
                    <small>
                        {{$item->score}} points by
                        <a href="">
                            <i class="fa-solid fa-user"></i>
                            {{$item->by}}
                        </a>
                    </small>
                    <small>
                        <a href="">
                            <i class="fa-regular fa-calendar"></i> 
                            {{\Carbon\Carbon::parse($item->time)->diffForHumans()}}
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
        @foreach ($item->comments as $comment)
            <div class="comment">
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
                            {{\Carbon\Carbon::parse($comment->time)->diffForHumans()}}
                        </a>
                    </small>
                    <small>
                        <a href="">
                            <i class="fa-solid fa-diagram-project"></i>
                            Parent
                        </a>
                    </small>
                </p>
                <div class="comment-text">
                    {!! property_exists($comment, 'text') ? $comment->text : '' !!}
                </div>
            </div>
        @endforeach
    </div>
@endsection
@props(['comment'])

<div class="comment">
    <p class="heading">
        <small>
            <a href="{{route('user', (is_array($comment)) ? $comment['by']: $comment->by)}}">
                <i class="fa-solid fa-user"></i>
                {{(is_array($comment)) ? $comment['by']: $comment->by}}
            </a>
        </small>
        <small>
            @php($time = (is_array($comment)) ? $comment['time']: $comment->time)
            <a href="">
                <i class="fa-regular fa-calendar"></i>
                {{\Carbon\Carbon::parse((integer)$time)->diffForHumans()}}
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
        @if (is_object($comment))
            {!! (property_exists($comment, 'text')) ? $comment->text : '' !!}
        @else
            {!! isset($comment['text']) ? $comment['text'] : '' !!}
        @endif
        <div>
            <small>
                @auth
                    <a href="{{route('comment', [
                        (is_array($comment)) ? $comment['original_id'] : $comment->original_id
                    ])}}" style="text-decoration: underline;">Replay</a>
                @else
                    <a href="{{route('get.signin')}}" style="text-decoration: underline;">Replay</a>
                @endauth
            </small>
        </div>
    </div>
</div>
@php($comment = (array)$comment)
@if (isset($comment['children']))
    @if (is_array($comment['children']) && !is_null($comment['children']) || !empty($comment['children']))
        @foreach ($comment['children'] as $child)
            @if ((is_array($child) || is_object($child)) && !is_null($child))
                <div class="" style="margin-left: 20px;">
                    <x-comment-item :comment="$child" />
                </div>
            @endif
        @endforeach
    @endif
@endif

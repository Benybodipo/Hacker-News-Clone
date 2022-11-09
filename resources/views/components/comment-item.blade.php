@props(['comment'])

<div class="comment">
    <p class="heading">
        <small>
            <a href="{{route('user', $comment['by'])}}">
                <i class="fa-solid fa-user"></i>
                {{$comment['by']}}
            </a>
        </small>
        <small>
            <a href="">
                <i class="fa-regular fa-calendar"></i> 
                {{\Carbon\Carbon::parse((integer)$comment['time'])->diffForHumans()}}
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
        {!! isset($comment['text']) ? $comment['text'] : '' !!}
        <div>
            <small>
                <a href="{{route('get.signin')}}" style="text-decoration: underline;">Replay</a>
            </small>
        </div>
    </div>
</div>
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
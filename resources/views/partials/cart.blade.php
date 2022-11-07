<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            <a href="">
                <span>{{$index}}</span>
                <i class="fa-solid fa-caret-up"></i>
                {{$item->title}}
            </a>
        </h5>
        <p class="card-text">
            <a href="{{$item->url}}">
                <i class="fa-solid fa-earth-americas"></i> 
                {{$item->url}}
            </a>
        </p> 
    </div>
    <div class="card-footer text-muted">
        <small>
            <span>{{$item->score}} points by</span>
            <a href="">
                <i class="fa-solid fa-user"></i>
                {{$item->by}}
            </a>
        </small>
        <small>
            <a href="">
                <i class="fa-solid fa-eye-slash"></i> Hide
            </a>
        </small>
        <small>
            <a href="">
                <i class="fa-regular fa-calendar"></i> {{\Carbon\Carbon::parse($item->time)->diffForHumans()}}
            </a>
        </small>
        <small>
            <a href="">
                <i class="fa-solid fa-eye-slash"></i> Hide
            </a>
        </small>
        <small>
            <a href="{{route('comments', [$item->id])}}">
                <i class="fa-solid fa-comment-dots"></i> {{(property_exists($item, 'kids')) ? count($item->kids) : 0}} Comments
            </a>
        </small>
    </div>
</div>
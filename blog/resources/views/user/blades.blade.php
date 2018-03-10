@if ($target_id->id != \Auth::id())
<div>
    @if ($target_id->hasFan(\Auth::id()))
        <button class="btn btn-default like-button" like-value="1" like-user="{{ $target_id->id }}" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
    @else
        <button class="btn btn-default like-button" like-value="0" like-user="{{ $target_id->id }}" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">关注</button>
    @endif
</div>
@endif
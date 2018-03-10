@extends('layout.main')
@section('content')
    <div class="blog-post">
        <div style="display:inline-flex">
            <h2 class="blog-post-title">{{ $post->title }}</h2>
            @can('update', $post)
            <a style="margin: auto" href="/posts/{{ $post->id }}/edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>
            @endcan
            @can('delete', $post)
            <a style="margin: auto" href="/posts/{{ $post->id }}/delete">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
            @endcan
        </div>

        <p class="blog-post-meta">May 14, 2017 by <a href="#">{{ $post->user->name }}</a></p>

        <p>{!! $post->content !!}</p>
        <div>
            @if($post->zan(\Auth::id())->exists())
                <a href="/posts/{{ $post->id }}/unzan" type="button" class="btn btn-primary btn-lg">取消赞</a>
            @else
                <a href="/posts/{{ $post->id }}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
            @endif
        </div>
    </div>

    @if (sizeof($post->comments))
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">评论</div>

        <!-- List group -->
        <ul class="list-group">
            @foreach($post->comments as $com_v)
            <li class="list-group-item">
                <h5>{{ $com_v->created_at }} by {{ $post->user->name }}</h5>
                <div>
                    {{ $com_v->content }}
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">发表评论</div>

        <!-- List group -->
        <ul class="list-group">
            <form action="/posts/{{ $post->id }}/comment" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                <li class="list-group-item">
                    <textarea name="content" class="form-control" rows="10"></textarea>
                    @include('layout.errors')
                    <button class="btn btn-default" type="submit" style="margin-top:10px;">提交</button>
                </li>
            </form>
        </ul>
    </div>
@endsection
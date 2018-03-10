@extends('layout.main')
@section('content')
    <div class="alert alert-success" role="alert">
        下面是搜索"{{ $query }}"出现的文章，共{{ $num }}条
    </div>
    <div class="col-sm-8 blog-main">
        @foreach($post as $posts)
            <div class="blog-post">
            <h2 class="blog-post-title"><a href="/posts/{{ $posts->id }}" >{{ $posts->title }}</a></h2>
            <p class="blog-post-meta">May 11, 2017 by <a href="#">Mark</a></p>
            <p>{!! str_limit($posts->content,100,'...') !!}</p>
        </div>
        @endforeach
        <ul class="pagination">
            {{ $post->links() }}
        </ul>
    </div><!-- /.blog-main -->
@endsection
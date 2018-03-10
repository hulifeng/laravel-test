@extends('layout.main')
@section('content')
    <form action="/posts/{{ $post->id }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group">
            <label>标题</label>
            <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label>内容</label>
            <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"
                      placeholder="这里是内容">&lt;p&gt;{{ $post->content }}&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;</textarea>
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    <br>
@endsection
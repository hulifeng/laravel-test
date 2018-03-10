@extends('layout.main')
@section('content')
    <blockquote>
        <p>
            <img src="/storage/9f0b0809fd136c389c20f949baae3957/iBkvipBCiX6cHitZSdTaXydpen5PBiul7yYCc88O.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 40px">{{ $info->name }}
            @include('user.blades',['target_id'=>$info])
        </p>
        <footer>关注：{{ $info->stars_count }}｜粉丝：{{ $info->fans_count }}｜文章：{{ $info->posts_count }}</footer>
    </blockquote>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                @foreach($post as $posts)
                <div class="blog-post" style="margin-top: 30px">
                    <p class=""><a href="/posts/{{ $posts->id }}">{{ $posts->title }}</a> {{ $posts->created_at->diffForHumans() }}</p>
                    <p class=""><a href="/posts/{{ $posts->id }}">{!! str_limit($posts->content) !!}</a></p>
                </div>
                @endforeach
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                @foreach ($stars as $star)
                    <?php $suser = $star->suser()->first();?>
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">{{ $suser->name }}</p>
                        <p class="">关注：1 | 粉丝：1｜ 文章：0</p>
                        @include('user.blades',['target_id'=>$suser])
                    </div>
                @endforeach
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                @foreach ($fans as $fan)
                    <?php $fuser = $fan->fuser()->first()?>
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">{{ $fuser->name }}</p>
                        <p class="">关注：{{ $fuser->stars()->count() }} | 粉丝：{{ $fuser->fans()->count() }}｜ 文章：{{ $fuser->posts()->count() }}</p>
                        @include('user.blades',['target_id'=>$fuser])
                    </div>
                @endforeach
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
@endsection


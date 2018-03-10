@include('layout.header')
<body>
<div class="blog-masthead">
    <div class="container">
        @include('layout.nav')

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <div>
                    <img src="/storage/9f0b0809fd136c389c20f949baae3957/iBkvipBCiX6cHitZSdTaXydpen5PBiul7yYCc88O.jpeg"
                         alt="" class="img-rounded" style="border-radius:500px; height: 30px">
                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">{{ \Auth::user()->name }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/user/{{ \Auth::user()->id }}">我的主页</a></li>
                        <li><a href="/user/{{ \Auth::user()->id }}/setting">个人设置</a></li>
                        <li><a href="/logout">登出</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="blog-header">
    </div>
    <div class="row">
        <div class="col-sm-8 blog-main">
            @yield('content')
        </div>
        @include('layout.sidebar')
    </div>
</div>
</div>
@include('layout.footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/wangEditor.min.js"></script>
<script src="/js/ylaravel.js"></script>

</body>
</html>

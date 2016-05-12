<!DOCTYPE html>
<html lang="zh-CN">
<head>
    {{--<meta charset="utf-8">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    {{--引入js文件--}}
    <script src="{{ url('dist/js/jquery.min.js') }}"></script>
    <script src="{{ url('dist/js/bootstrap.js') }}"></script>


    <!-- Noty 提示框的js集成 -->
    <script src="{{ url('dist/noty-2.2.9/packaged/jquery.noty.packaged.js') }}"></script>
    <script src="{{ url('dist/noty-2.2.9/themes/bootstrap.js') }}"></script>
    <script src="{{ url('dist/noty-2.2.9/options.js') }}"></script>
    <!-- Fonts -->


    <!-- Plupload上传类 -->
    <script src="{{ url('dist/plupload-2.1.2/plupload.full.min.js') }}"></script>
    <script src="{{ url('dist/plupload-2.1.2/i18n/zh_CN.js') }}"></script>

    <!-- 百度编辑器 -->
    <script src="{{ url('dist/ueditor/utf8-php/ueditor.config.js') }}"></script>
    <script src="{{ url('dist/ueditor/utf8-php/ueditor.all.min.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('Invest') }}">投资人信息录入</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">群发邮件</a></li>
            </ul>

            <ul class="nav navbar-nav">
                <li><a href="{{ route('Phone') }}">群发手机</a></li>
            </ul>

            {{--@if(\App\User::whereId(Auth::user()->id)->first()->email =='')--}}
            <ul class="nav navbar-nav">
                <li><a href="{{ route('Group') }}">投资人分组</a></li>
            </ul>
            {{--@endif--}}

            <ul class="nav navbar-nav">
                <li><a href="{{ route('Edit') }}">投资人信息编辑</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="adminId" data ="{{ Auth::user()->id }}">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container" style="width:100%">
    <div class="row">
        @yield('content')
        <div class="col-md-2 ">
            <div class="panel panel-default">
                <div class="panel-heading">投资人</div>
                <div class="panel-body" style="overflow:auto; height: 600px">
                    @foreach(\App\Investor::where('role' , '!=' ,'1')->get() as $invest)
                        <label style="display:block">
                            <ul >
                                <li ><a href="#" data-id="{{ $invest->id }}">{{ $invest->name }}</a></li>
                            </ul>
                        </label>
                    @endforeach

                    <hr/>

                    {{--@foreach(\App\Groups::all() as $group)--}}
                        {{--<p href="#error-menu{{ $group->id }}"  class="nav-header collapsed" data-toggle="collapse" style="display:block"><i class="icon-exclamation-sign"></i>{{ $group->invest_group }}<i class="icon-chevron-up"></i><em>&nbsp;&nbsp;&nbsp;&nbsp;{{ count(\App\Groups::find($group->id)->invest_x_groups()->get()) }}人</em></p>--}}
                        {{--<ul id="error-menu{{ $group->id }}" class="nav nav-list collapse">--}}
                           {{--@foreach(\App\Groups::find($group->id)->invest_x_groups()->get() as $invest)--}}
                               {{--@if($invest->role !== 1)--}}
                            {{--<li ><a href="#" data-id="{{ $invest->id }}">{{ $invest->name }}</a></li>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--@endforeach--}}
                </div>
            </div>
        </div>

        {{--user = 1 才显示--}}
        <div class="col-md-2 adminId" style="display: none">
            <div class="panel panel-default">
                <div class="panel-heading">投资人</div>
                <div class="panel-body" style="overflow:auto; height: 600px">
{{--                    @if(\App\User::whereId(Auth::user()->id)->first()->email =='592560885@qq.com')--}}
                    @foreach(\App\Investor::whereRole('1')->get() as $in)
                        <label style="display:block">
                            <ul >
                                <li ><a href="#" data-id="{{ $in->id }}">{{ $in->name }}</a></li>
                            </ul>
                        </label>
                    @endforeach
                    {{--@endif--}}
                    <hr/>

                    @foreach(\App\Groups::all() as $group)
                        <p href="#error-menu{{ $group->id }}"  class="nav-header collapsed" data-toggle="collapse" style="display:block"><i class="icon-exclamation-sign"></i>{{ $group->invest_group }}<i class="icon-chevron-up"></i><em>&nbsp;&nbsp;&nbsp;&nbsp;{{ count(\App\Groups::find($group->id)->invest_x_groups()->get()) }}人</em></p>
                        <ul id="error-menu{{ $group->id }}" class="nav nav-list collapse">
                            @foreach(\App\Groups::find($group->id)->invest_x_groups()->get() as $invest)
                                <li ><a href="#" data-id="{{ $invest->id }}">{{ $invest->name }}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    jQuery(function() {
        var doc = $(document);
//获取 投资人email
        var str = "";
        var id = "";
        doc.on("click", ".panel-body a", function () {
            str += $(this).text() + ";";
            id += $(this).attr("data-id") + ";";
            $(".id").val(id.slice(0, -1));
            $(".user").val(str);
        });

        var adminId = $('#adminId').attr('data');
        if(adminId == 1){
            $('.adminId').show();
        }else{
            $('.adminId').hide();
        }

    });


</script>

</body>
</html>
